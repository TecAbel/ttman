<?php
    include 'header-admin.php';
?>

    <div class="contenedor contenedor-app clearfix">
        <h1>Bienvenido Administrador</h1>
        <hr>
    </div>

    <div class="contenedor contenedor-app bg-gris">
        <div class="contenedor-campos">
            <form id="frmAdmin" method="post" onsubmit="javascript:return false;">
                <div class="campo w-100">
                    <input type="text" id="txtUsuario" name="txtUsuario" placeholder="usuario">
                </div>
                <div class="campo w-100">
                    <input type="password" id="txtPase" name="txtPase" placeholder="contraseña">
                </div>
                <div class="campo">
                    <input class="btn primario" id="btnEntrar" type="submit" value="Entrar">
                </div>
            </form>
        </div>
    </div>

    <?php
    include 'footer-admin.php';
?>