<?php
    include '../php/includes/header.php';
?>
<div class="contenedor contenedor-app clearfix">
    <h1>Ingreso</h1>
    <hr>
</div>

<div class="contenedor contenedor-app bg-gris">
    <div class="contenedor-campos">
        <form id="frmIngreso" method="post" onsubmit="javascript:return false;">
            <div class="campo w-100">
                <input type="text" id="txtUsuario" name="txtUsuario" placeholder="usuario">
            </div>
            <div class="campo w-100">
                <input type="password" id="txtPase" name="txtPase" placeholder="contraseña">
            </div>
            <div class="campo">
                <input class="btn azul" id="btnEntrar" type="submit" value="Entrar">
            </div>
        </form>
    </div>
</div>


<?php
    include '../php/includes/footer.php';
?>