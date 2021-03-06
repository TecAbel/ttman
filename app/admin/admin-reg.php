<?php
    //require '../../php/config.php';
    //var_dump($_POST);
    if(!isset($_POST)){
        header('Location: admin-usuarios');
    }else{
        $correo = filter_var($_POST['txtCorreo'], FILTER_SANITIZE_STRING);
        $nombre = filter_var($_POST['txtNombre'], FILTER_SANITIZE_STRING);
        $numero = filter_var($_POST['txtTelefono'], FILTER_SANITIZE_STRING);;
        $pase = password_hash($_POST['txtPase'], PASSWORD_DEFAULT);
        try {
            require_once('../../php/config.php');
            $stmt = $conn->prepare("INSERT INTO `usuarios`(`correo`, `nombre_user`,`numero`,`pase`) VALUES (?,?,?,?)");
            $stmt->bind_param('ssss', $correo, $nombre,$numero, $pase);
            $stmt->execute();
            $stmt->close();
            $msg = true;
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }
        try {
            require_once('../../php/config.php');
            $stmt = $conn->prepare("SELECT num_usuario FROM usuarios WHERE correo = ?");
            $stmt->bind_param('s', $correo);
            $stmt->execute();
            $stmt->bind_result($num_usuario);
            $stmt->fetch();
            $stmt->close();
            $conn->close();
            $msg = true;
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }

        $carpeta = '../files/'.$num_usuario;
        mkdir($carpeta, 0777, true);

        echo $msg;
    }
    
?>