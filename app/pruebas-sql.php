<?php
    try {
        require_once('../php/config.php');
        $fecha_reporte = date('Y-m-d');
        echo $fecha_reporte;
        $sql = "SELECT reporte_total
        FROM reportes 
        WHERE num_usuario = 13 AND num_emp = 2 AND fecha = '$fecha_reporte'";
        echo $sql;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($reporte_total);
        $stmt->fetch();
        echo $reporte_total;
        $stmt->close();
        
    } catch (Exception $th) {
        echo $th->getMessae();
    } 
?>