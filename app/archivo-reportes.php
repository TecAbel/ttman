<?php
    include '../php/includes/header.php';
    session_start();
    if(!isset($_SESSION['llave'])){
        header('Location: ../php/destroy.php');
    }
    
    $empEnc=$_GET['emp'];
?>

<div class="contenedor contenedor-app clearfix">
    <a href="actividades-control?emp=<?php echo $empEnc ?>" class="btn volver"><i class="fas fa-chevron-left"></i> Volver</a>
    <?php
        try {
            require_once('../php/config.php');
            require_once('../php/SED.php');
            $llave = $_SESSION['llave'];
            $emp = SED::decryption($empEnc);
            $sql = "SELECT url_reporte, nombre_emp
                    FROM reportes 
                    INNER JOIN empleadores
                    ON reportes.num_emp = empleadores.num_emp
                    WHERE reportes.num_emp = ? AND reportes.num_usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $emp, $llave);
            $stmt->execute();
            $stmt->bind_result($url, $nombre_emp);
            $stmt->fetch();
            $stmt->close();
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    ?>
    <h1>Historial de reportes con <?php echo $nombre_emp ?></h1>
</div>
    
    

<?php
    include '../php/includes/footer.php';?>