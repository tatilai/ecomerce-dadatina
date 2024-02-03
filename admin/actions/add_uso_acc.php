<?php
require_once "../../functions/autoload.php";

$postData=$_POST;

echo"<pre>";
print_r($postData);
echo"</pre>";


try{
    
    (new Uso())->incrustar($postData['forma_de_aplicacion']);

    (new Alerta())->add_alerta('success', "La forma de uso  <strong>{$postData['forma_de_aplicacion']} </strong> se cargó correctamente");
    header('Location: ../index.php?sec=admin_modo_uso');
}catch(Exception $e){

   // echo"<pre>";
    //print_r($e);
    //echo"</pre>";
   // die("no se puedo cargar el tipo de piel");

    (new Alerta ())->add_alerta('danger',"Ocurrió un error inesperado por favor ponganse en contacto con eladministrador de sistema");
    header('Location: ../index.php?sec=admin_modo_uso');
}
