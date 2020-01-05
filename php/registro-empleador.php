<?php
    #var_dump($_POST);
    session_start();
    if($_SESSION['llave'] and $_SESSION['correo']){
        if($_POST){
            $llave = $_SESSION['llave'];
            $nombre = filter_var($_POST['txtNombre'], FILTER_SANITIZE_STRING);
            $empresa = filter_var($_POST['txtEmpresa'], FILTER_SANITIZE_STRING);
            $correo = filter_var($_POST['txtCorreo'], FILTER_SANITIZE_STRING);
            $telefono = filter_var($_POST['txtTelefono'], FILTER_SANITIZE_STRING);
            $cuota = filter_var($_POST['txtCuota'], FILTER_VALIDATE_INT);


            try {
                require_once('config.php');
                $sql = "INSERT INTO empleadores (num_usuario, nombre_emp, nombre_emp_emp, correo_emp, tel_emp, cuota) VALUES (?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sssssi',$llave, $nombre,$empresa,$correo,$telefono,$cuota);
                $stmt->execute();
                $stmt->close();
                $msg = true;
            } catch (Exception $th) {
                $msg = $th->getMessage();
            }
            try {
                require_once('config.php');
                $sql = "SELECT num_emp 
                        FROM empleadores 
                        WHERE nombre_emp = ? AND num_usuario = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ii',$nombre,$llave);
                $stmt->execute();
                $stmt->bind_result($num_emp);
                $stmt->fetch();
                $stmt->close();
                ;
                
                $conn->close();
                $msg = true;
            } catch (Exception $th) {
                $msg = $th->getMessage();
            }

            
            $carpeta = '../app/files/'.$llave.'/'.$num_emp;
            mkdir($carpeta, 0777, true);
            echo $msg;
        }
    }
?>