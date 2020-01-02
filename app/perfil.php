<?php
    include '../php/includes/header.php';
    session_start();
    if(!isset($_SESSION['llave'])){
        header('Location: ../php/destroy.php');
    }
    require_once('../php/SED.php');
    $llave = $_SESSION['llave'];
    
    $llaveEnc = SED::encryption($_SESSION['llave']);
?>

    <div class="contenedor contenedor-app clearfix">
        <h1>Mi perfil</h1>
        <hr>
        <p class="centrado">
            <small class="centrado">Aquí podrás ver tu información y actualizar tu teléfono de contacto.</small> <br><strong><span class="color-amarillo">Nota:</span></strong> La CLABE será para que tus empleadores te puedan depositar.
        </p>
    </div>
    
    <div class="contenedor bg-gris">
        <div class="contendor-campos">
            <form action="" id="frmPerfil" method="post">
                <?php
                    try {
                        require_once('../php/config.php');
                        $sql = "SELECT nombre_user,correo,numero, rfc, clabe, banco FROM usuarios WHERE num_usuario = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('i', $llave);
                        $stmt->execute();
                        $stmt->bind_result($nombre,$correo,$numero,$rfc,$clabe,$banco);
                        $stmt->fetch();
                    } catch (Exceptio $th) {
                        echo $th->getMessage();
                    }
                ?>
                <div class="campo">
                    <p class="centrado"><label for="txtNombre"><strong><?php echo $nombre ?></strong></label></p>
                </div>
                <div class="campo">
                    <p class="centrado"><label for="txtCorreo"><strong><?php echo $correo ?></strong></label></p>
                </div>
                <div class="campo">
                    <label for="txtTelefono">Teléfono:</label>
                    <input type="tel" name="txtTelefono" value="<?php echo $numero ?>" id="txtTelefono">
                </div>
                <div class="campo">
                        <label for="txtRFC">RFC:</label>
                        <input class="color-verde" value="<?php echo $rfc ?>" type="tel" name="txtRFC" id="txtRFC">
                    </div>
                <div class="campo">
                    <label for="txtClabe">CLABE:</label>
                    <input class="color-verde" value="<?php echo $clabe ?>" type="tel" name="txtClabe" id="txtClabe">
                </div>
                <div class="campo">
                    <label for="txtBanco">Banco:</label>
                    <input class="color-verde" value="<?php echo $banco ?>" type="tel" name="txtBanco" id="txtBanco">
                </div>
                <div class="campo w-100">
                    <input type="submit" id="btnActualizar" class="btn primario" value="Actualizar info">
                </div>
                
            </form>
            <div class="campo w-100">
                <a href="actualizar-password?sEc=<?php echo $llaveEnc ?>"><button class="btn azul">Cambiar contraseña</button></a>
            </div>
        </div>
    </div>

<?php
    $stmt->close();
    $conn->close();
    include '../php/includes/footer.php';
?>