<?php
    session_start();
    if(!isset($_SESSION['llave'])){
        header('Location: ../');
    }
    $llave  = $_SESSION['llave'];
    if(isset($_POST)){
        $inicio = $_POST['txtInicio'];
        $salida = $_POST['txtSalida'];
        $detalle = $_POST['txtDetalle'];
        $transporte = $_POST['txtTransporte'];
        $num_empEnc = $_POST['txtEmp'];
        require_once('SED.php');
        $num_emp = SED::decryption($num_empEnc);

        /* Cálculo de horas redondeo a partir de media hora */

        $diferencia = strtotime($salida) - strtotime($inicio);
        $horas = $diferencia / 3600;
        $horas_final = round($horas, 0, PHP_ROUND_HALF_UP);
        try {
            require_once('config.php');
            $sqlCalculo = "UPDATE calculos 
                    SET hora_ent = ?, hora_sal = ?, horas_tra = ?, descripcion = ?, transporte = ?
                    WHERE num_emp = ? AND num_usuario = ?";
            $stmtCalculo = $conn->prepare($sqlCalculo);
            $stmtCalculo->bind_param('ssssiii', $inicio, $salida, $horas_final, $detalle,$transporte, $num_emp, $llave);
            $stmtCalculo->execute();
            $stmtCalculo->close();
        } catch (Exception $th) {
            $msg = $th->getMessage();
        }
        /*Cálculo de subtotal */
        try {
            require_once('config.php');
            $sqlSubtotal="
            UPDATE calculos 
            SET subtotal_cal =  (
                horas_tra*(
                SELECT cuota 
                FROM empleadores 
                where num_usuario = ?
                AND num_emp = ?
                )
            )
            WHERE calculos.num_emp = ? AND calculos.num_usuario = ?;
            ";
            $stmtSubtotal = $conn->prepare($sqlSubtotal);
            $stmtSubtotal->bind_param('iiii',$llave,$num_emp,$num_emp,$llave);
            $stmtSubtotal->execute();
            $stmtSubtotal->close();
        } catch (Exception $th) {
            $msg = $th->getMessage();
        }
         /* Cálculo del total */
         try {
            require_once('config.php');
            $sqlTotal = "
                UPDATE calculos
                SET total_cal = (
                    subtotal_cal + transporte
                )
                WHERE calculos.num_emp = ? AND calculos.num_usuario = ?;
            ";
            $stmtTotal = $conn->prepare($sqlTotal);
            $stmtTotal->bind_param('ii', $num_emp,$llave);
            $stmtTotal->execute();
            $stmtTotal->close();
            $conn->close();
        } catch (Exception $th) {
            $msg = $th->getMessage();
        }
        $msg = true;
        
    }else{
        header('Location: ../');
    }
    echo $msg;

?>