<?php
    include '../php/includes/header.php';
    session_start();
    if(!isset($_SESSION['llave'])){
        header('Location: ../');
    }
?>

    <div class="contenedor contenedor-app clearfix">
        <h1>Aquí encontrarás a tus empleadores</h1>
        <hr>
        <p class="centrado"><small>Haciendo clic sobre el empleador accederás al menú de control para agregar tus actividades, generar reportes y más.</small></p>
    </div>

    <div class="contenedor">
        <?php
        $llave  = $_SESSION['llave'];
            try {
                require_once('../php/config.php');
                $sql = "SELECT num_emp,nombre_emp FROM empleadores WHERE num_usuario = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('i', $llave);
                $stmt->execute();
                $stmt->bind_result($emp,$nombreEmpleador);
            } catch (Exception $th) {
                echo $th->getMessage();
            }
        ?>
        <div class="contenedor-empleadores">
            <div class="empleador-cuadro ">
                <a href="nuevo-empleador"><button class="boton-circular verde"><p><i class="fas fa-plus"></i></p></button></a>
            </div>
    
            <?php
                while($stmt->fetch()){  
                    require_once('../php/SED.php');
                    $empEnc = SED::encryption($emp); ?>
                <div class="empleador-cuadro ">
                    <a href="actividades-control?emp=<?php echo $empEnc?>"><button class="boton-circular"><i class="fas fa-user-tie"></i><p><?php echo $nombreEmpleador?></p></button></a>
                </div>
            <?php    }
            ?>
        </div>
    </div>
<?php
    $stmt->close();
    $conn->close();
    include '../php/includes/footer.php';
?>