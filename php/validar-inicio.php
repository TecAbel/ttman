<?php
    if($_POST){
        #$msg = '';
        $correo = filter_var($_POST['txtUsuario'], FILTER_SANITIZE_STRING);
        $pase = filter_var($_POST['txtPase'], FILTER_SANITIZE_STRING);

        try {
            require_once('config.php');
            $sql = "SELECT pase FROM usuarios WHERE correo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $correo);
            $stmt->execute();
            $stmt->bind_result($paseDb);
            $stmt->fetch();
            $stmt->close();
            $conn->close();
        } catch (Exception $th) {
            echo $th->getMessage();
        }
        #echo $paseDb;
        if(isset($paseDb)){
            if(password_verify($pase,$paseDb)){
                $msg = true;
                session_start();
                $_SESSION['correo'] = $correo;
            }
            else{
                $msg = false;
            }
        }

        echo $msg;
    }
?>