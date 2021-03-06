<?php
    include '../php/includes/header.php';
    session_start();
    if(!isset($_SESSION['llave']) or !isset($_GET['emp'])){
        header('Location: ../php/destroy.php');
    }
    $llave = $_SESSION['llave'];
    $empEnc = $_GET['emp'];
?>

    <div class="contenedor contenedor-app clearfix">
        <a href="empleadores" class="btn volver"><i class="fas fa-chevron-left"></i> Volver</a>
        <a href="archivo-reportes?emp=<?php echo $empEnc?>" class="btn volver der"><i class="fas fa-folder-open"></i> Reportes</a>
        <h2>Control de actividades</h2>
        <?php try {
            require_once('../php/config.php');
            require_once('../php/SED.php');
            $num_emp = SED::decryption($empEnc);
            $sql = "SELECT nombre_emp FROM empleadores WHERE num_emp = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i',$num_emp);
            $stmt->execute();
            $stmt->bind_result($nombreEmp);
            $stmt->fetch();
            $stmt->close();
        } catch (Exception $th) {
            echo $th->getMessage();
        }?>
        <h3><?php echo $nombreEmp ?> </h3>
        <hr>
        <p class="centrado"><small>Aquí podrás acceder a tus actividades registradas con este empleador e interactuar con dicha información.</small>
        <p class="centrado"><span class="color-amarillo">NOTA:</span><small>Dando clic en la fecha de una actividad podrás editarla o eliminarla.</small></p>
        </p>
        
        <div class="seccion-reporte bg-gris clearfix">
            <div class="total">
                Total al momento <strong><span class="color-verde">$<span class="monto-total"></span></span></strong>
            </div>
            <div class="btns-archivo">
                <a href="registro-actividad?emp=<?php echo $empEnc ?>"><i class="color-verde fas fa-plus-circle"></i></a>
                <a href="previo-reporte?emp=<?php echo $empEnc ?>"><i class="far fa-file-pdf"></i></a>
            </div>
        </div>

        <div class="contenedor tablas">
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
        <h2>Detalles</h2>
        <div class="contenedor tablas ">
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
    </div>
<?php
$conn->close();
    include '../php/includes/footer.php';
?>