<?php
    ob_start();
?>

<body style='font-family: arial;'>
    
        
        <H1 style='text-align:center;'>Nota de remisión</H1> 
            
        <div style='width: 80%; margin: 0 auto; padding: 15px' >
            <p style='text-align: justify text-justify: inter-word;'>
                Quien suscribe el presente documento <strong> $nombre  </strong>, manifiesta haber recibido a su entera satisfacción la cantidad de <strong>$ $totalReporte </strong> MXN, misma que es entregada por <strong> $empelador </strong> $textoEmpresa, en efectivo, por concepto de:
            <p>
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
                    
                    
                        
                    
                    <tr style='background-color: #28a745; '>
                        <th colspan='3' style='color: white; padding: 15px 10px 5px 10px; !important;'>Total</th>
                        <th style='color: white; padding: 15px 10px 5px 10px; !important;'>$ $totalReporte</th>
                    </tr>
                    
                </tbody>
                
                
            </table>
        </div>
        <br>
        <br>
        <h3 style='text-align: center;'>Detalles</h3>
        <div>
            <table style='margin: 0 auto; width: 100%; border-spacing: 0px 10px; border-radious: 10px;'>
                
                
                <thead style='text-align: center; '>
                    <tr style='background-color: #343a40;'>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Fecha</th>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Inicio</th>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Salida</th>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Transporte</th>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Total horas</th>
                    </tr>
                </thead>
                <tbody style='text-align:center;'>
                    <tr>
                        <td>21/01/11</td>
                        <td>13:00</td>
                        <td>14:00</td>
                        <td>$150</td>
                        <td>3</td>
                    </tr>
                </tbody>
                
                
            </table>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div style='text-align:center; width:300px; margin: 0 auto; color:black;'>
        <tr>
            <td><hr width='30%'/></td>
        </tr>
            <strong><span style='color: black'> $nombre </span></strong>
        </div>
        <div align='center' style='font-size: 10px; width: 80%; margin: 10px auto; color:#6c757d;'>
            <p style='text-align: center'>
                <strong>Documento generado en https://grh-beta.000webhostapp.com/ </strong>   
                <br> GRH solo genera estos reportes <strong>con los datos que el usuario haya ingresado</strong>, con el fin de ayudar en la administración de reportes de actividades de un usuario que labore por honorarios.
                Por lo anterior, GRH no se hace responsable de la información que el mismo usuario haya ingresado y presente en este documento.
            </p>
        </div>
</body>

<?php $content = ob_get_clean()?>
<?php
    require_once '../vendor/autoload.php';
    #$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
    #$html = utf8_encode($html);
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($content);
    ob_end_clean();
    $mpdf->Output($filename, 'I'); 
    $mpdf->charset_in='windows-1252';
?>