<?php
    include '../php/includes/header.php';
    session_start();
    if(!isset($_SESSION['llave']) or !isset($_GET['act'])){
        header('Location: ../');
    }
    require_once('../php/SED.php');
    $llave = $_SESSION['llave'];
    $actEnc = $_GET['act'];
    $actDec = SED::decryption($actEnc);
?>
<?php try {
            require_once('../php/config.php');
            
            $sql = "SELECT num_emp,actividades.nombre_act,fecha,hora_ent,hora_sal,horas_tra,descripcion,transporte FROM calculos INNER JOIN actividades ON actividades.num_actividad = calculos.num_actividad WHERE num_cal = ? AND calculos.num_usuario =?";
            $stmtCal = $conn->prepare($sql);
            $stmtCal->bind_param('ii',$actDec, $llave);
            $stmtCal->execute();
            $stmtCal->bind_result($num_emp,$actividad, $fecha, $hora_ent, $hora_sal, $horas_tra, $detalle, $transporte);
            $stmtCal->fetch();
            $num_empEnc = SED::encryption($num_emp);
        } catch (Exception $th) {
            echo $th->getMessage();
        } 
        $fecha_format = date_create($fecha);
        ?>

<div class="contenedor contenedor-app clearfix">
    <a href="actividades-control?emp=<?php echo $num_empEnc ?>" class="btn volver"><i class="fas fa-chevron-left"></i>Volver</a>
    <div class="nota-der" ><span class="obligatorio">Nota:</span> Los espacios de fecha y actividad no se puede borrar, si desea cambiar, se recomienda borrar y volver a registrar.</div>
    <div class="seccion-reporte bg-gris">
        <div class="contenedor-campos">
        <form onsubmit="javascript: return false;" id="frmUpdateCalculo" method="post">
            <div class="campo">
                <label for="txtFecha">Fecha:</label>
                <input type="text" class="obligatorio" value="<?php echo date_format($fecha_format, 'd/m/y')?>" readonly id="txtFecha">
            </div>
            <div class="campo">
                <label for="txtInicio">Inicio:</label>
                <input type="time" value="<?php echo $hora_ent?>" id="txtInicio" name="txtInicio">
            </div>
            <div class="campo">
                <label for="txtSalida">Salida:</label>
                <input type="time" value="<?php echo $hora_sal?>" id="txtSalida" name="txtSalida">
            </div>
            <div class="campo">
                <label for="txtActividad" >Actividad:</label>
                <input type="text" class="obligatorio" value="<?php echo $actividad?>" readonly id="txtActividad" autocomplete="off">
            </div>
            <div class="campo w-100">
                <label for="txtDetalle">Detalle actividad:</label>
                
                <textarea name="txtDetalle"  id="txtDetalle" cols="30" rows="10" placeholder="Detalle sobre la actividad"><?php echo $detalle?></textarea>
            </div>
            <div class="campo">
                <label for="txtTransporte">Transporte: $</label>
                <input type="number" value="<?php echo $transporte?>" id="txtTransporte" name="txtTransporte" class="color-verde">
            </div>
            <input type="hidden" id="txtEmp" name="txtEmp" value="<?php echo $num_emp ?>">
            <div class="campo w-100">
                <input type="submit" id="btnActividadUpdate" class="btn verde" value="Editar actividad">
                <a href="actividades-control?emp=<?php echo $num_empEnc?>" class="btn azul">Regresar</a>
            </div>
        </form>
        </div>
    </div>
</div>



<?php include '../php/includes/footer.php';?>