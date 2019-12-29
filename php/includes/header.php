<?php $paginaActual = $_SERVER['REQUEST_URI']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Courgette|Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <title>TTMAN</title>
</head>
<body>
    <div class="barra">
        <div class="contenedor clearfix">
            <div class="logo-nav">
                <a href="../">
                    <img src="../img/logo-pequeno.png" alt="TTMAN">
                </a>
            </div>

            <div class="menu-movil">
                <i class="fas fa-bars"></i>
            </div>

            <div class="navegacion-principal">
                <?php 
                if($paginaActual == '/ttman/app/' or $paginaActual == '/ttman/app/index'){ 
                    echo '<a href="../">Salir</a>';
                }  
                else{
                    echo '<a href="empleadores" class="activo">Empleadores</a>
                        <a href="perfil">Perfil</a> 
                        <a href="../">Salir</a>';
                }  
                ?>
                
            </div>
        </div>
    </div>

    