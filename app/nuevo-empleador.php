<?php
    include '../php/includes/header.php';
    if(!isset($_SESSION['llave'])){
        header('Location: destroy');
    }
?>
<div class="contenedor contenedor-app clearfix">
    <a href="empleadores" class="btn volver"><i class="fas fa-chevron-left"></i>Volver</a>
    
    <p class="centrado"><small>No olvides llenar los cuadros <span class="obligatorio">OBLIGRATORIOS</span></small></p>
</div>
        
<div class="contenedor bg-gris">
    <div class="contenedor-campos">
        <form onsubmit="javascript: return false;" id="frmNewEmpleador" method="post">
            <div class="campo">
                <label for="txtNombre" class="obligatorio">Nombre:</label>
                <input type="text" id="txtNombre" name="txtNombre" placeholder="Nombre completo Empleador">
            </div>
            <div class="campo">
                <label for="txtEmpresa">Empresa:</label>
                <input type="text" id="txtEmpresa" name="txtEmpresa" placeholder="Empresa empleadora">
            </div>
            <div class="campo">
                <label for="txtCorreo">Correo:</label>
                <input type="text" id="txtCorreo" name="txtCorreo" placeholder="EJ: usuario@gmail.com">
            </div>
            <div class="campo">
                <label for="txtTelefono" class="obligatorio">Teléfono:</label>
                <input type="tel" id="txtTelefono"  name="txtTelefono" placeholder="máx 10">
            </div>
            <div class="campo">
                <label for="txtCuota" class="obligatorio">Cuota por hora $:</label>
                <input type="number" id="txtCuota" name="txtCuota">
            </div>
            <div class="campo w-100">
                <input type="submit" class="btn verde" id="btnRegistrar" value="Registrar empleador">
            </div>
        </form>
    </div>
</div>
<?php
    include '../php/includes/footer.php';
?>