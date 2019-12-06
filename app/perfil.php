<?php
    include '../php/includes/header.php';
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
                <div class="campo">
                    <p class="centrado"><label for="txtNombre"><strong>Abelardo Aqui Arroyo</strong></label></p>
                </div>
                <div class="campo">
                    <p class="centrado"><label for="txtCorreo"><strong>abel1996abel@gmail.com</strong></label></p>
                </div>
                <div class="campo">
                    <label for="txtTelefono">Teléfono:</label>
                    <input type="tel" name="txtTelefono" id="txtTelefono">
                </div>
                <div class="campo">
                    <label for="txtTelefono">CLABE:</label>
                    <input class="color-verde" type="tel" name="txtTelefono" id="txtTelefono">
                </div>
                <div class="campo">
                    <label for="txtTelefono">Banco:</label>
                    <input class="color-verde" type="tel" name="txtTelefono" id="txtTelefono">
                </div>
                <div class="campo w-100">
                    <input type="submit" class="btn primario" value="Actualizar info">
                </div>
                
            </form>
        </div>
    </div>

<?php
    include '../php/includes/footer.php';
?>