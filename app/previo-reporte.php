<?php
    session_start();
    if(!isset($_SESSION['llave']) or !isset($_GET['emp'])){
        header('Location: ../php/destroy.php');
    }
    $llave = $_SESSION['llave'];
    $empEnc = $_GET['emp'];


    try {
        require_once('../php/config.php');
        require_once('../php/SED.php');
        $emp = SED::decryption($empEnc);
        $sql = "SELECT nombre_user, banco, clabe, nombre_emp, nombre_emp_emp 
                FROM usuarios
                INNER JOIN empleadores ON usuarios.num_usuario = empleadores.num_usuario
                WHERE empleadores.num_usuario = ? AND empleadores.num_emp = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $llave, $emp);
        $stmt->execute();
        $stmt->bind_result($nombre_user, $banco, $clabe, $nombre_emp, $nombreEmpresa);
        $stmt->fetch();
        $stmt->close();
        #$conn->close();
    } catch (Exception $th) {
        echo $th->getMessage();
    }
    
?>

<?include '../php/includes/header.php';?>
<div class="contenedor contenedor-app clearfix">
    <a href="actividades-control?emp=<?php echo $empEnc?>" class="btn volver"><i class="fas fa-chevron-left"></i>Volver</a>
        <h3>Verifique la información.</h3>
        <hr>
        <div class="seccion-reporte bg-gris">
        
            <div class="contenedor-campos">
            
            <form onsubmit="javascript: return false;" id="frmPrevioReporte" method="post">
                <div class="campo w-100">
                    <h4 class="centrado">Nota de remisión</h4>
                </div>
                <div class="campo">
                    <label>Fecha: <strong id="txtFecha"><?php echo date('d/m/Y') ?></strong></label>
                </div>
                <div class="campo">
                    <label>Nombre: <strong id="txtNombre"><?php echo $nombre_user ?></strong></label>
                </div>
                <div class="campo">
                    <label>Banco: <strong><span  class="color-verde" id="txtBanco"><?php echo $banco ?></span></strong></label>
                    <label>Clabe: <strong><span  class="color-verde"><?php echo $clabe ?></span></strong></label>
                </div>
                <div class="campo">
                    <label>Para: <strong><?php echo $nombre_emp ?></strong> de <strong><?php echo $nombreEmpresa ?></strong></label>
                </div>
                <div class="campo w-100">
                    <label>Pronductos / servicios: </label>
                </div>
            <div class="contenedor tablas campo w-100">
            <table id="tablaPrincipal" class="tabla-actividades">
                <thead>
                    <th>Fecha</th>
                    <th>Actividad</th>
                    <th>Detalle actividad</th>
                    <th>Monto</th>
                </thead>
                <tbody>
                    <?php try {
                        require_once('../php/config.php');
                        require_once('../php/SED.php');
                        $num_emp = SED::decryption($empEnc);
                        $sql = "SELECT num_cal,fecha,actividades.nombre_act, hora_ent, hora_sal, descripcion, transporte, subtotal_cal, total_cal 
                        FROM calculos 
                        INNER JOIN actividades
                        ON calculos.num_actividad = actividades.num_actividad
                        WHERE calculos.num_usuario = ? AND calculos.num_emp = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('ii', $llave, $num_emp);
                        $stmt->execute();
                        $stmt->bind_result($num_cal,$fecha,$actividad,$hora_ent,$hora_sal,$detalle, $transporte, $subtotal,$total);
                    } catch (Exception $th) {
                        echo $th->getMessae();
                    }
                    while($stmt->fetch()){
                        $fecha_format = date_create($fecha);
                        $num_cal_enc = SED::encryption($num_cal);
                        ?>
                        <tr>
                            <td><strong><a href="editar-actividad?act=<?php echo $num_cal_enc ?>"><?php echo date_format($fecha_format, 'd/m/y')?></a></strong></td>
                            <td><?php echo $actividad?></td>
                            <td><?php echo $detalle?></td>
                            <td class="color-verde">$<span><?php echo $subtotal?></span></td>
                        </tr>
                        <?php
                    }
                    $stmt->close();
                    ?>
                    
                </tbody>
            </table>

            
        </div>
        <div class="seccion-reporte bg-gris clearfix subtotal">
           <div class="float-left centrado">
               Subtotal
           </div>
           <div class="float-right centrado">
               <strong class="color-verde">$<span id="txtSubtotal"></span></strong>
           </div>
        </div>
        <div class="campo w-100">
            <label>Detalles: </label>
        </div>
        <div class="contenedor tablas campo w-100 ">
            <table id="tablaDetalles" class="tabla-detalles">
                <thead>
                    <th>Fecha</th>
                    <th>Inicio</th>
                    <th>Salida</th>
                    <th>Transporte</th>
                    <th>Total horas</th>
                </thead>
                <tbody>
                    <?php try {
                        require_once('../php/config.php');
                        require_once('../php/SED.php');
                        $num_emp = SED::decryption($empEnc);
                        $sql = "SELECT fecha, hora_ent, hora_sal, transporte, horas_tra
                        FROM calculos 
                        INNER JOIN actividades
                        ON calculos.num_actividad = actividades.num_actividad
                        WHERE calculos.num_usuario = ? AND calculos.num_emp = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('ii', $llave, $num_emp);
                        $stmt->execute();
                        $stmt->bind_result($fecha,$hora_ent,$hora_sal, $transporte, $horas);
                    } catch (Exception $th) {
                        echo $th->getMessae();
                    }?>
                    <?php while($stmt->fetch()){
                        $fecha_format = date_create($fecha);
                        ?>
                        <tr>
                            <td><strong><?php echo date_format($fecha_format, 'd/m/y') ?></strong></td>
                            <td><?php echo $hora_ent ?></td>
                            <td><?php echo $hora_sal ?></td>
                            <td class="color-verde">$<span><?php echo $transporte ?></span></td>
                            <td><?php echo $horas ?></td>
                        </tr>
                        <?php
                    }
                    $stmt->close();
                    ?>
                </tbody>
            </table>
        </div>
        <div class="seccion-reporte bg-gris clearfix subtotal">
            <div class="float-left centrado">
                Transporte
            </div>
            <div class="float-right centrado">
                <strong class="color-verde">$ <span id="txtTransporte"></span> </strong>
            </div>
         </div>
         <div class="campo w-100 total">
            
                <p class="centrado">Total: <strong><span class="color-verde">$<span class="monto-total"></span></span></strong></p>
            
         </div>
         <div class="campo w-100">
                <input type="submit" id="btnGenerarReporte" class="btn verde" value="Generar reporte">
            </div>
            </div>
            
            </form>
            </div>
        </div>
        
    </div>
    
<?include '../php/includes/footer.php';?>