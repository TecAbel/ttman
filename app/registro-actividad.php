<?php
    include '../php/includes/header.php';
    session_start();
    if(!isset($_SESSION['llave'])){
        header('Location: destroy');
    }

    $empEnc = $_GET['emp'];
    
    $fecha = date('Y-m-d');
    
?>

    <div class="contenedor contenedor-app clearfix">
    <a href="actividades-control?emp=<?php echo $empEnc?>" class="btn volver"><i class="fas fa-chevron-left"></i>Volver</a>
        <h2>Ingrese la información que se le solicita.</h2>
        <hr>
        <div class="seccion-reporte bg-gris">
            <div class="contenedor-campos">
            <form onsubmit="javascript: return false;" id="frmRegistroActividad" method="post">
                <div class="campo">
                    <label for="txtFecha">Fecha:</label>
                    <input type="date" value=<?php echo $fecha ?> id="txtFecha" name="txtFecha">
                </div>
                <div class="campo">
                    <label for="txtInicio">Inicio:</label>
                    <input type="time" id="txtInicio" name="txtInicio">
                </div>
                <div class="campo">
                    <label for="txtSalida">Salida:</label>
                    <input type="time" id="txtSalida" name="txtSalida">
                </div>
                <div class="campo">
                    <label for="txtActividad" class="obligatorio">Actividad:</label>
                    <input type="text" name="txtActividad" list="actividadesRegistradas" id="txtActividad" autocomplete="off">
                    <datalist id="actividadesRegistradas">
                        <?php 
                            try {
                                $llave = $_SESSION['llave'];
                                require_once('../php/config.php');
                                $sql = "SELECT nombre_act 
                                        FROM actividades
                                        WHERE num_usuario = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('i',$llave);
                                $stmt->execute();
                                $stmt->bind_result($actividad);
                            } catch (Exception $th) {
                                $error = $th->getMessage();
                                echo '<option value="'.$error.'">'.$error.'</option>';
                            }

                            while($stmt->fetch()){
                                echo '<option value="'.$actividad.'">'.$actividad.'</option>';
                            }
                        ?>
                    </datalist>
                </div>
                <div class="campo w-100">
                    <label for="txtDetalle">Detalle actividad:</label>
                    
                    <textarea name="txtDetalle" id="txtDetalle" cols="30" rows="10" placeholder="Detalle sobre la actividad"></textarea>
                </div>
                <div class="campo">
                    <label for="txtTransporte">Transporte: $</label>
                    <input type="number" id="txtTransporte" name="txtTransporte" class="color-verde">
                </div>
                <input type="hidden" id="txtEmp" name="txtEmp" value="<?php echo $empEnc ?>">
                <div class="campo w-100">
                    <input type="submit" id="btnRegistrar" class="btn verde" value="Registrar Actividad">
                    <a href="actividades-control?emp=<?php echo $empEnc?>" class="btn azul">Regresar</a>
                </div>
            </form>
            </div>
        </div>
    </div>
<?php
    $stmt->close();
    $conn->close();
    include '../php/includes/footer.php';
?>