<?php
    include '../php/includes/header.php';
?>

<div class="contenedor contenedor-app clearfix">
    <a href="perfil" class="btn volver"><i class="fas fa-chevron-left"></i>Volver</a>
    <?php 
        if(isset($_GET['sEc'])){
            include('../php/SED.php');
            $id = $_GET['sEc'];
            $idDecrypt = SED::decryption($id);
            try {
                require_once('../php/config.php');
                
                $stmt = $conn->prepare("SELECT nombre_user, correo FROM usuarios WHERE num_usuario = ?");
                $stmt->bind_param('i', $idDecrypt);
                $stmt->execute();
                $stmt->bind_result($nombre, $correo);
                $stmt->fetch();
                #echo $nombre ." y ". $correo;
                $stmt->close();
                $conn->close();
            } catch (\Exception $th) {
                echo $th->getMessage();
            }
        }else{
            echo "hubo un error";
        }
    ?>
    <h2>Cambia tu contraseña</h2>
    <hr>
</div>

<div style="margin:2% auto;" class="contenedor bg-gris">
    <div class="contenedor-campos">
        <?php
            if(isset($nombre) && isset($correo)){
            ?>
                <form method="POST" id="frmCambioPass" onsubmit="javascript: return false;">
                    <div class="campo">
                        <label for="txtNombre">Nombre: </label>
                        <input id="txtNombre" type="text" value="<?php echo $nombre?>" readonly>
                    </div>
                    <div class="campo">
                        <label for="txtCorreo">Correo: </label>
                        <input id="txtCorreo" value="<?php echo $correo ?>" type="text" readonly>
                    </div>
                    <div class="campo w-100">
                        <label for="txtPase">Nueva contraseña: </label>
                        <input id="txtPase" type="password">
                    </div>
                    <div class="campo w-100">
                        <label for="txtPase1">Confirmar contraseña: </label>
                        <input id="txtPase1" name="txtPase1" type="password">
                    </div>
                    <input type="hidden" value="<?php echo $idDecrypt ?>" name="txtId">
                    <div class="campo w-100">
                    <input class="btn primario" id="btnCambio" type="submit" value="Cambiar contraseña">
                </div>
                </form>
        <?php
            }

        ?>
    </div>
</div>



<?php
    include '../php/includes/footer.php';
?>