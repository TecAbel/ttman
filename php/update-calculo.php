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
        $empleador = $_POST['txtEmp'];

        /* Cálculo de horas redondeo a partir de media hora */

        $diferencia = strtotime($salida) - strtotime($inicio);
        $horas = $diferencia / 3600;
        $horas_final = round($horas, 0, PHP_ROUND_HALF_UP);
        try {
            require_once('config.php');
            $sql = "UPDATE calculos 
                    SET hora_ent = ?, hora_sal = ?, horas_tra = ?, descripcion = ?, transporte = ?
                    WHERE num_emp = ? AND num_usuario = ?";
            $stmt = $conn->prepare($sql);
        } catch (Exception $th) {
            $msg = $th->getMessage();
        }
    }

?>