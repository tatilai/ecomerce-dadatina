<?php
require_once "../../functions/autoload.php";


$postData = $_POST;
$fileData = $_FILES['imagen'];

 echo "<pre>";
print_r($_POST);
echo "</pre>"; 



echo "<pre>";
print_r($_FILES);
echo "</pre>"; 

//echo "Fecha de vencimiento: " . $postData['vencimiento'] . "<br>";

try{

    $dadatina= new Dadatina();

    $imagen = (new Imagen())->verImagen(__DIR__ . "/../../img/cremas", $fileData);

    $idDadatina= $dadatina->insert(
        $postData['titulo'],
        $postData['categoria_id'],
        $postData['producto'],
        $postData['contenido_neto'],
        $postData['modo_de_uso_id'],
        $postData['proteccion_solar'],
        $postData['producto_hipoalergenico'],
        $postData['momento_de_aplicacion'],
        $postData['tipo_de_piel_id'],
        $imagen,
        $postData['vencimiento'],        
        $postData['precio']
    );

    foreach($postData['ingredientes'] as $ingredientes_id){
        $dadatina->add_ingredientes_dadatina($idDadatina, $ingredientes_id);
    }


    (new Alerta())->add_alerta('success', "El producto se cargó correctamente");
    
    header('Location: ../index.php?sec=admin_skin_care');

}catch(Exception $e){
    // echo "<pre>";
    // print_r($e->getMessage());
    // echo "<pre>";
    // die("No se pudo cargar el producto =(");

    (new Alerta ())->add_alerta('danger',"Ocurrió un error inesperado por favor ponganse en contacto con eladministrador de sistema");
    header('Location: ../index.php?sec=admin_skin_care');

}