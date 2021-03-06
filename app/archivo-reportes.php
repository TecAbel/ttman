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

<div class="contenedor bg-gris">
    <div class="contenedor-campos">
        <?php
            try {
                require_once('../php/config.php');
                require_once('../php/SED.php');
                $llave = $_SESSION['llave'];
                $emp = SED::decryption($empEnc);
                $sql = "SELECT id_reporte, fecha, url_reporte
                        FROM reportes
                        WHERE num_usuario = ? AND num_emp = ?
                        ORDER BY id_reporte DESC";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ii', $llave, $emp);
                $stmt->execute();
                $stmt->bind_result($num_reporte,$fecha, $url);
            } catch (Exception $th) {
                echo $th->getMessage();
            }

            while($stmt->fetch()){
                $fecha_format = date_create($fecha);
                $new_url = substr($url,7);
                ?>
                <div class="campo">
                    <a class="btn pdf" href="<?php echo $new_url ?>">Reporte de <?php echo date_format($fecha_format,'d/m/Y') ?> <i class="far fa-file-pdf"></i></a>
                </div>
                <?php
            }
            $stmt->close();
            $conn->close();
        ?>
    </div>
</div>
    
    

<?php
    include '../php/includes/footer.php';?>