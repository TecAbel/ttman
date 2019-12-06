<?php
    include '../php/includes/header.php';
?>

    <div class="contenedor contenedor-app clearfix">
        <a href="empleadores" class="btn volver"><i class="fas fa-chevron-left"></i>Volver</a>
        <h1>Control de actividades</h1>
        <h3>Carlos Sosa</h3>
        <hr>
        <p class="centrado"><small>Aquí podrás acceder a tus actividades registradas con este empleador e interactuar con dicha información.</small>
        <p class="centrado"><span class="color-amarillo">NOTA:</span><small>Dando clic en la fecha de una actividad podrás editarla o eliminarla.</small></p>
        </p>
        
        <div class="seccion-reporte bg-gris clearfix">
            <div class="total">
                Total al momento <strong><span class="color-verde">$1080</span></strong>
            </div>
            <div class="btns-archivo">
                <a href="registro-actividad"><i class="color-verde fas fa-plus-circle"></i></a>
                <a href="#"><i class="far fa-file-pdf"></i></a>
            </div>
        </div>

        <div class="contenedor tablas">
            <table class="tabla-actividades">
                <thead>
                    <th>Fecha</th>
                    <th>actividad</th>
                    <th>Detalle actividad</th>
                    <th>Monto</th>
                </thead>
                <tbody>
                    <tr>
                        <td><strong><a href="">04/12/19</a></strong></td>
                        <td>Desarrollo</td>
                        <td>Pruebas de desarrollo en TTMAN</td>
                        <td class="color-verde">$300</td>
                    </tr>
                    <tr>
                        <td><strong><a href="">04/12/19</a></strong></td>
                        <td>Desarrollo</td>
                        <td>Pruebas de desarrollo en TTMAN</td>
                        <td class="color-verde">$300</td>
                    </tr>
                        <tr>
                        <td><strong><a href="">04/12/19</a></strong></td>
                        <td>Desarrollo</td>
                        <td>Pruebas de desarrollo en TTMAN</td>
                        <td class="color-verde">$300</td>
                    </tr>
                </tbody>
            </table>

            
        </div>
        <div class="seccion-reporte bg-gris clearfix subtotal">
           <div class="float-left centrado">
               Subtotal
           </div>
           <div class="float-right centrado">
               <strong class="color-verde">$900</strong>
           </div>
        </div>
        <h2>Detalles</h2>
        <div class="contenedor tablas ">
            <table class="tabla-detalles">
                <thead>
                    <th>Fecha</th>
                    <th>Inicio</th>
                    <th>Salida</th>
                    <th>Transporte</th>
                    <th>Total horas</th>
                </thead>
                <tbody>
                    <tr>
                        <td><strong><a href="">04/12/19</a></strong></td>
                        <td>10:00</td>
                        <td>13:00</td>
                        <td class="color-verde">$70</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td><strong><a href="">04/12/19</a></strong></td>
                        <td>10:00</td>
                        <td>13:00</td>
                        <td class="color-verde">$70</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td><strong><a href="">04/12/19</a></strong></td>
                        <td>10:00</td>
                        <td>13:00</td>
                        <td class="color-verde">$140</td>
                        <td>3</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="seccion-reporte bg-gris clearfix subtotal">
            <div class="float-left centrado">
                Transporte
            </div>
            <div class="float-right centrado">
                <strong class="color-verde">$280</strong>
            </div>
         </div>
    </div>
<?php
    include '../php/includes/footer.php';
?>