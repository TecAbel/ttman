<?php
    //var_dump($_POST);
    if($_POST){
        $usuario = filter_var($_POST['txtUsuario'], FILTER_SANITIZE_STRING) ;
        $pase = filter_var($_POST['txtPase'], FILTER_SANITIZE_STRING);
        $conn = new mysqli('localhost', $usuario, $pase,'ttman');
        if($conn->connect_error){
            $mensaje = $conn->connect_error;
            //$mensaje = false;
        }
        else{
            $mensaje = true;
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['pase'] = $pase;
        }
        echo $mensaje;
        $conn->close();
    }
    
?>