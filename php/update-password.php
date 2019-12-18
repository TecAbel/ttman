<?php
    if(isset($_POST['txtPase1']) && isset($_POST['txtId'])){
        require('SED.php');
        $id =$_POST['txtId'];
        $nuevoPase = $_POST['txtPase1'];
        $paseEn = password_hash($nuevoPase, PASSWORD_DEFAULT);
        try {
            require_once('config.php');
            $sql = "UPDATE usuarios SET pase = ? WHERE num_usuario = ? ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si',$paseEn,$id);
            $stmt->execute();
            if($stmt->affected_rows == 1){
                $msg = true;
            }else{
                $msg = "Error en ejecución";
            }
            $stmt->close();
            $conn->close();

            echo $msg;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }else{
        echo "falta información";
    }
?>