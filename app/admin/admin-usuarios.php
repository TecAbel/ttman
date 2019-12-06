<?php
    include 'header-admin.php';
?>
    <div class="contenedor contenedor-app clearfix">
        <h1>Administrador de usuarios</h1>
        <hr>
    </div>

    <div class="contenedor contenedor-app bg-gris">
        <div class="contenedor-campos">
            <div class="campo">
                <label for="txtNombre">Nombre:</label>
                <input type="text" name="txtNombre" id="txtNombre" placeholder="Abelardo Aqui Arroyo">
            </div>
            <div class="campo">
                <label for="txtCorreo">Correo:</label>
                <input type="text" name="txtCorreo" id="txtCorreo" placeholder="correo">
            </div>
            <div class="campo">
                <label for="txtCorreoC">Confirmar correo:</label>
                <input type="text" name="txtCorreoC" id="txtCorreoC" placeholder="correo">
            </div>
            <div class="campo">
                <label for="txtPase">Contraseña:</label>
                <input type="password" name="txtPase" id="txtPase" placeholder="correo">
            </div>
            <div class="campo">
                <label for="txtPaseC">Confirmar contraseña:</label>
                <input type="password" name="txtPaseC" id="txtPaseC" placeholder="correo">
            </div>
            <div class="campo">
                <input class="btn primario" type="submit" value="Crear cuenta">
            </div>
        </div>
    </div>

<?php
    include 'footer-admin.php';
?>


