<?php
    session_start();
    $llave = $_SESSION['llave'];
    $telefono = filter_var($_POST['txtTelefono'], FILTER_SANITIZE_STRING);
    $rfc = filter_var($_POST['txtRFC'], FILTER_SANITIZE_STRING);
    $clabe = filter_var($_POST['txtClabe'], FILTER_SANITIZE_STRING);
    $banco = filter_var($_POST['txtBanco'], FILTER_SANITIZE_STRING);
    try {
        require_once('config.php');
        $sql = " UPDATE usuarios SET numero = ?, rfc = ?, clabe = ?, banco = ?             WHERE num_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssi',$telefono,$rfc,$clabe,$banco,$llave);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        $msg = true;
    } catch (Exception $th) {
        $msg = $th->getMessage();
    }
    echo $msg;
?>