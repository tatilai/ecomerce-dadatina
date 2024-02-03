<?php
require_once "../../functions/autoload.php";

$postData=$_POST;

echo"<pre>";
print_r($postData);
echo"</pre>";


try{
    (new Categoria())->insertar($postData['nombre_categoria']);

    (new Alerta())->add_alerta('success', "La categoria <strong>{$postData['nombre_categoria']} </strong> se cargó correctamente");

    header('Location: ../index.php?sec=admin_categorias');
}catch(Exception $e){

   // echo"<pre>";
    //print_r($e);
    //echo"</pre>";
  //  die("no se puedo cargar el tipo de piel");

  (new Alerta ())->add_alerta('danger',"Ocurrió un error inesperado por favor ponganse en contacto con eladministrador de sistema");
  header('Location: ../index.php?sec=admin_categorias');
}