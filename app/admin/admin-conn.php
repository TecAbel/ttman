<?php
    //var_dump($_POST);
    if($_POST){
        $usuario = $_POST['txtUsuario'];
        $pase = $_POST['txtPase'];
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