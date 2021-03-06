<!--
    Autor: Abelardo Aqui
    Año: 2019
    Proyecto: ttman
    Detalles: nueva cara de GRH
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Courgette|Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
    <!--PWA-->
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#D57E40"/>
    <link rel="apple-touch-icon" href="img/icono-pwa.jpg">

    <title>TTMAN</title>
</head>
<body id="index">
    <div class="hero sombra clearfix">
        <div class="logo-btns clearfix">
            <div class="logo">
                <img src="img/logo.png" alt="ttman">
            </div>
            <div class="contenedor-btns">
                <a href="app/" class="btn primario">Entrar</a>
                <a href="#contacto" class="btn secundario">Contacto</a>
            </div>
        </div>
    </div>
    <div class="contenedor contenedor-index sombra">
        <h2>Agrega un toque <span class="color-primario">especial</span> a tus reportes de cobro</h2>
        <hr>

        <div class="contenedor-articulo clearfix">
            <div class="parrafo float-left">
                <h3>¿Cómo funciona?</h3>
                <p>Registra tus actividades</p>
                <p>Nosotros calculamos el precio</p>
                <p>Imprime o envía tu reporte a tus empleadores</p>
            </div>
            <img class="float-right" src="img/calculadora.jpg" alt="calc">
        </div>

        <hr>

        <div class="contenedor-articulo clearfix">
            <div class="parrafo float-right">
                <h3>Solo necesitas...</h3>
                <p>Ingresar tus datos y los de tus empleadores</p>
                <p>¡Y estarás listo para empezar!</p>
            </div>
            <img class="float-left" src="img/usuarios.png" alt="usuarios">
        </div>

        <hr>

        <h2> ¿Te interesa? <strong class="color-primario">¡Contáctanos!</strong> </h2>

        <div id="contacto" class="contenedor-articulo clearfix">
            <form  action="#" method="post">
                <div class="campos float-left">
                    <input type="text" placeholder="Tu nombre">
                    <input type="text" placeholder="Tu correo">
                </div>
                <button class="float-right btn-img"><img  src="img/enviar.png" alt="enviar"></button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>Abelardo Aqui | 2019</p>
    </footer>
</body>
</html>