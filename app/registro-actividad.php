<?php
    include '../php/includes/header.php';
?>

    <div class="contenedor contenedor-app clearfix">
        <h2>Ingrese la información que se le solicita.</h2>
        <hr>
        <div class="seccion-reporte bg-gris">
            <div class="contenedor-campos">
            <form action="" method="post">
                <div class="campo">
                    <label for="txtFecha">Fecha:</label>
                    <input type="date" id="txtFecha">
                </div>
                <div class="campo">
                    <label for="txtInicio">Inicio:</label>
                    <input type="time" id="txtInicio">
                </div>
                <div class="campo">
                    <label for="txtSalida">Salida:</label>
                    <input type="time" id="txtSalida">
                </div>
                <div class="campo">
                    <label for="txtActividad">Actividad:</label>
                    
                    <select name="txtActividad" id="">
                        <option value="1">Servicio</option>
                    </select>
                </div>
                <div class="campo w-100">
                    <label for="txtDetalle">Detalle actividad:</label>
                    
                    <textarea name="txtDetalle" id="txtDetalle" cols="30" rows="10" placeholder="Detalle sobre la actividad"></textarea>
                </div>
                <div class="campo">
                    <label for="txtTransporte">Transporte: $</label>
                    <input type="number" class="color-verde">
                </div>
                <div class="campo w-100">
                    <button class="btn primario">Registrar</button>
                    <a href="actividades-control" class="btn secundario">Regresar</a>
                </div>
            </form>
            </div>
           
        </div>
        
    </div>
<?php
    include '../php/includes/footer.php';
?>