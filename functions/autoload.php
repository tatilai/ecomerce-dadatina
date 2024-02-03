<?php
session_start();
function autoloadClasses($nombreClase){


    $ubicacionArchivo=__DIR__ .  "/../classes/$nombreClase.php";

    if(file_exists($ubicacionArchivo)){
        require_once $ubicacionArchivo;
    }else{
        die("no se pudo cargar la clase:$nombreClase");
    }
}

spl_autoload_register('autoloadClasses');