<?php
    session_start();
    if(!isset($_SESSION['llave']) or !isset($_GET['emp'])){
        header('Location: ../php/destroy.php');
    }
    $llave = $_SESSION['llave'];
    $empEnc = $_GET['emp'];
    require_once('../php/SED.php');
    $emp = SED::decryption($empEnc);


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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/estilos-reporte.css">
    <title>Document</title>
</head>


<?php
    ob_start();
?>

<body style='font-family: arial;'>
    
        
        <div  style="margin: 0 auto;" class="clearfix">
            <div style="width: 70%; float: left;">
                <H1>Nota de remisión a <?php echo date('d/m/Y') ?></H1> 
            </div>
            <div style="width: 60px; float: right; right: 0; top: 0;">
                <img style="max-width: 60px" src="../img/logo-pequeno.jpg" alt="TTMAN">
            </div>
        </div>
        
            
        <div style='margin: 0 auto;' class="clearfix" >
            <div style='text-align: left; text-justify: inter-word; float:left; width:50%;'>
                <p>De: <?php echo $nombre_user ?></p>
                <p>Banco: <span style="color: #28a745;"><?php echo $banco ?></span></p>
                <p>Clabe: <span style="color: #28a745;"><?php echo $clabe ?></span></p>
            </div>
            <div style='text-align: left; text-justify: inter-word; float:right; width:50%;'>
                <p>Para: <?php echo $nombre_emp ?></p>
                <p>De la empresa: <?php echo $nombreEmpresa ?></p>
            </div>
        </div>
        <div>
            <table style='margin: 0 auto; width: 100%; border-spacing: 0px 10px; border-radious: 10px;'>
                
                
                <thead style='text-align: center; '>
                    <tr style='background-color: #343a40;'>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Fecha</th>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Concepto</th>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Detalle</th>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Monto</th>
                    </tr>
                </thead>
                <tbody style='text-align:center;'>
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
                            <td style="padding: 5px; text-align: center; font-size: 13px;" id="txtFecha_tb"><?php echo date_format($fecha_format, 'd/m/Y')?></td>
                            <td style="padding: 5px; text-align: center; font-size: 13px;" id="txtActividad_tb"><?php echo $actividad?></td>
                            <td style="padding: 5px; text-align: center; font-size: 13px;" id="txtDetalle_tb"><?php echo $detalle?></td>
                            <td style="padding: 5px; text-align: center; font-size: 13px; color: #28a745;" class="color-verde" id="txtSubtotal_tb">$<span><?php echo $subtotal?></span></td>
                        </tr>
                        <?php
                    }
                    $stmt->close();
                    ?>
                    
                    
                </tbody>
                
                
            </table>
        </div>
        <br>
        <div>
            <table style='margin: 0 auto; width: 100%; border-spacing: 0px 10px; border-radious: 10px;'>
                
                
                <thead style='text-align: center; '>
                    <tr style='background-color: #343a40;'>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Fecha</th>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Inicio</th>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Salida</th>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Total horas</th>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Transporte</th>
                    </tr>
                </thead>
                <tbody style='text-align:center;'>
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
                            <td style="padding: 5px; text-align: center; font-size: 13px;" id="txtFecha_tb" id="txtFechaDetalle"><?php echo date_format($fecha_format, 'd/m/y') ?></td>
                            <td style="padding: 5px; text-align: center; font-size: 13px;" id="txtFecha_tb" id="txtHoraEntDetalle"><?php echo $hora_ent ?></td>
                            <td style="padding: 5px; text-align: center; font-size: 13px;" id="txtFecha_tb" id="txtHoraSalDetalle"><?php echo $hora_sal ?></td>
                            <td style="padding: 5px; text-align: center; font-size: 13px; color: #28a745;" id="txtFecha_tb" id="txtHorasDetalle"><?php echo $horas ?></td>
                            <td style="padding: 5px; text-align: center; font-size: 13px; color:#28a745;" id="txtFecha_tb" >$<span id="txtTransporteDetalle" ><?php echo $transporte ?></span></td>
                        </tr>
                        <?php
                    }
                    $stmt->close();
                    ?>
                    <?php
                        try {
                            require_once('../php/config.php');
                            require_once('../php/SED.php');
                            $fecha_reporte = date('Y-m-d');
                            $num_emp = SED::decryption($empEnc);
                            $sql = "SELECT id_reporte,reporte_total, url_reporte
                            FROM reportes
                            WHERE num_usuario = ? AND num_emp = ? AND fecha = '$fecha_reporte' 
                            ORDER BY id_reporte DESC LIMIT 1";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param('ii', $llave, $num_emp);
                            $stmt->execute();
                            $stmt->bind_result($id_reporte,$reporte_total, $url);
                            $stmt->fetch();
                            $stmt->close();
                        } catch (Exception $th) {
                            echo $th->getMessae();
                        }
                        $filename = $url;
                    ?>
                        
                    
                    <tr style='background-color: #28a745; '>
                        <th colspan='4' style='color: white; padding: 15px 10px 5px 10px; !important;'>Total</th>
                        <th style='color: white; padding: 15px 10px 5px 10px; !important;'>$ <?php echo $reporte_total ?></th>
                    </tr>
                </tbody>
                
                
            </table>
        </div>
        <br>
        <br>
        <br>
        <br>
        
        
        <div align='center' style='font-size: 10px; width: 100%; margin: 10px auto; color:#6c757d;'>
            <p style='text-align: center'>
                <strong>Documento generado en https://ttman-beta.000webhostapp.com/ </strong>   
                <br> TTMAN solo genera estos reportes <strong>con los datos que el usuario haya ingresado</strong>, con el fin de ayudar en la administración de reportes de actividades de un usuario que labore por honorarios.
                Por lo anterior, TTMAN no se hace responsable de la información que el mismo usuario haya ingresado y presente en este documento.
            </p>
        </div>
</body>
</html>

<?php $content = ob_get_clean()
?>
<?php
    /**
     * eliminar información ya guardada
     */
    try {
        require_once('../php/config.php');
        require_once('../php/SED.php');
        $emp = SED::decryption($empEnc);
        $sql = "DELETE FROM calculos WHERE num_usuario = ? AND num_emp = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii',$llave, $emp);
        $stmt->execute();
        $stmt->close();
        $msg = true;
    } catch (Exception $th) {
        $msg = $th->getMessage();
    }
    /**
     * generar reporte
     */
    
    $conn->close();
    require_once '../vendor/autoload.php';
    #$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
    #$html = utf8_encode($html);
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($content);
    ob_end_clean();
    $mpdf->Output($filename, 'F'); 
    $mpdf->charset_in='windows-1252';
    header('Location: archivo-reportes?emp='.$empEnc);
?>