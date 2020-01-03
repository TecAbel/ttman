<?php  
    if($_POST){
        session_start();
        $emp = filter_var($_POST['empEnc'], FILTER_SANITIZE_NUMBER_INT);
        $fecha = date('Y-m-d');
        $fechaFile = date('dmY');
        $llave = $_SESSION['llave'];
        $json_detalle = json_encode($_POST);
        echo $json_detalle;
        $urlReporte = '../app/files/ttman'.$llave.$emp.$fechaFile.'.pdf';
        try {
            require_once('config.php');
            $sql = "INSERT INTO `reportes`(`num_usuario`, `url_reporte`, `fecha`, `num_emp`, `reporte_detalle`) VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('issis',$llave, $urlReporte, $fecha, $emp, $json_detalle);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            $msg = true;
        } catch (Exception $th) {
            $msg = $th->getMessage();
        }
        echo $msg;
    }



?>