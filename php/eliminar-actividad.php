<?php
    session_start();
    if(!isset($_SESSION['llave'])){
        header('Location: destroy.php');
    }
    $llave = $_SESSION['llave'];

    if(isset($_GET['killAct'])){
        $num_actEnc = $_GET['killAct'];
        require_once('SED.php');
        $num_act = SED::decryption($num_actEnc);
        try {
            require_once('config.php');
            $sql = "DELETE FROM calculos WHERE num_usuario = ? AND num_cal = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $llave, $num_act);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            $msg = true;
        } catch (Exception $th) {
            $msg = $th->getMessage();
        }
    }else{
        header('Location: destroy.php');
    }
    echo $msg;
?>