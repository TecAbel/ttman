<?php
    include '../php/includes/header.php';
?>

    <div class="contenedor contenedor-app clearfix">
        <h1>Aquí encontrarás a tus empleadores</h1>
        <hr>
        <p class="centrado"><small>Haciendo clic sobre el empleador accederás al menú de control para agregar tus actividades, generar reportes y más.</small></p>
    </div>

    <div class="contenedor">
        <div class="contenedor-empleadores">
        <div class="empleador-cuadro ">
                <a href="nuevo-empleador"><button class="boton-circular verde"><p><i class="fas fa-plus"></i></p></button></a>
            </div>
            <div class="empleador-cuadro ">
                <a href="actividades-control"><button class="boton-circular"><i class="fas fa-user-tie"></i><p>Carlos Sosa</p></button></a>
            </div>

            <div class="empleador-cuadro ">
                <a href="">
                    <button class="boton-circular"><i class="fas fa-user-tie"></i><p>Alfredo Gutiérrez</p></button>
                </a>
            </div>

            <div class="empleador-cuadro ">
                <button class="boton-circular"><i class="fas fa-user-tie"></i><p>Katia Murguía</p></button>
            </div>
            <div class="empleador-cuadro ">
                <button class="boton-circular"><i class="fas fa-user-tie"></i><p>Cristina</p></button>
            </div>
        </div>
    </div>
<?php
    include '../php/includes/footer.php';
?>