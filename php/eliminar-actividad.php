<?php
    session_start();
    if(!isset($_SESSION['llave'])){
        header('Location: destroy');
    }

    if(isset($_GET['kill-act'])){

    }else{
        header('Location: destroy');
    }
?>