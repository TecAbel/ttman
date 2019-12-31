<?php
    session_start();
    if($_SESSION['llave']){
        if($_POST){
            require_once('SED.php');
            $llave = $_SESSION['llave'];
            $num_empEnc = filter_var($_POST['txtEmp'], FILTER_SANITIZE_STRING);
            $num_emp = SED::decryption($num_empEnc);
            $fecha = filter_var($_POST['txtFecha'], FILTER_SANITIZE_STRING);
            $inicio = filter_var($_POST['txtInicio'], FILTER_SANITIZE_STRING);
            $salida = filter_var($_POST['txtSalida'], FILTER_SANITIZE_STRING);
            $actividad = filter_var($_POST['txtActividad'], FILTER_SANITIZE_STRING);
            $detalle = filter_var($_POST['txtDetalle'], FILTER_SANITIZE_STRING);
            $transporte = filter_var($_POST['txtTransporte'], FILTER_SANITIZE_NUMBER_INT);

            /* Cálculo de horas redondeo a partir de media hora */

            $diferencia = strtotime($inicio) - strtotime($salida);
            $horas = $diferencia / 3600;
            $horas_final = round($horas, 0, PHP_ROUND_HALF_UP);


            try {
                /*Registro de actividad si es que esta es nueva */
                require_once('config.php');
                $sqlActividad = "
                    INSERT  INTO actividades(nombre_act, num_usuario) 
                    SELECT * FROM( SELECT '$actividad','$llave') AS tmp
                    WHERE NOT EXISTS (
                        SELECT nombre_act FROM actividades WHERE nombre_act = ?
                    ) limit 1;
                ";
                $stmtActividad = $conn->prepare($sqlActividad);
                $stmtActividad->bind_param('s',$actividad);
                $stmtActividad->execute();
                $stmtActividad->close();
                $conn->close();
            } catch (Exception $th) {
                echo $th->getMessage();
            }
            echo $actividad;
            try {
                 /*Registro del cálculo */
                 require_once('config.php');
                 $sqlCalculo = "INSERT INTO calculos(num_usuario,num_emp,num_actividad,fecha,hora_ent,hora_sal,horas_tra,descripcion,transporte)
                 VALUES(?, ?,(SELECT num_actividad FROM actividades WHERE nombre_act = '$actividad'),?,?,?,?,?,?);";
 
                 $stmtCalculo = $conn->prepare($sqlCalculo);
                 $stmtCalculo->bind_param('iisssisi',$llave,$num_emp,$fecha,$inicio,$salida,$horas_final,$detalle,$transporte);
                 $stmtCalculo->execute();
                 $stmtCalculo->close();
                 $conn->close();
            } catch (Exception $th) {
                echo $th->getMessage();
            }
        }
    }

?>