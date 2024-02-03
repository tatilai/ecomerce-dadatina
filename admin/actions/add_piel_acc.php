<?php
require_once "../../functions/autoload.php";

$postData=$_POST;

echo"<pre>";
print_r($postData);
echo"</pre>";


try{

    (new Piel())->insert($postData['tipo_piel']);

   
    (new Alerta())->add_alerta('success', "El tipo de piel <strong>{$postData['tipo_piel']} </strong> se cargó correctamente");

   header('Location: ../index.php?sec=admin_tipo_piel');

}catch(Exception $e){

    // echo"<pre>";
    // print_r($e);
    // echo"</pre>";
    // die("no se puedo cargar el tipo de piel");

    (new Alerta ())->add_alerta('danger',"Ocurrió un error inesperado por favor ponganse en contacto con eladministrador de sistema");
    header('Location: ../index.php?sec=admin_tipo_piel');
}

