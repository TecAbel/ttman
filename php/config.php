<?php
    $host = 'localhost';
    $usuario = 'root';
    $password = 'root';
    $db = 'ttman';
    $conn = mysqli_connect($host, $usuario, $password,$db) or die("Conexión falló" . mysqli_connect_error());
?>