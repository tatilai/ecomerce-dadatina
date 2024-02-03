 <?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$fileData = $_FILES['imagen'] ?? FALSE;
$id = $_GET['id'] ?? FALSE;
// echo"<pre>";
// print_r($id);
// print_r($postData);
// print_r($fileData);
// echo "</pre>";
// die("hola");

//    echo "<pre>";
//    print_r($postData);
//    echo"</pre>";

  try {

   $dadatina = (new Dadatina())->producto_x_identificacion($id);

//    echo "<pre>";
//    print_r($dadatina);
//    echo"</pre>";

   // var_dump($dadatina);

  

   var_dump($postData['imagen_og']);
    if (!empty($fileData['tmp_name'])) {
        //El usuario decidio rempazar la imagen
        $imagen = (new Imagen())->verImagen(__DIR__ . "/../../img/cremas", $fileData);
        if(!empty($postData['imagen_og']))
        {
            (new Imagen())->borrarImagen(__DIR__ . "/../../img/cremas/" . $postData['imagen_og']);
        }        
    }else{
        //El usuario decidio quedarse con la imagen original
        $imagen = $postData['imagen_og'];
    }

    echo"<pre>";
   print_r($dadatina);
   echo "</pre>";

  $dadatina->clear_cremas();

    if (isset($postData['ingredientes'])) {
        foreach ($postData['ingredientes'] as $ingredientes_id) {
            $dadatina->add_ingredientes_dadatina($id, $ingredientes_id);
        }
    }

//    $dadatina->edit(
//        $postData['titulo'],
//        $postData['categoria_id'],
//         $postData['producto'],
//         $postData['contenido_neto'],
//        $postData['modo_de_uso_id'],
//         $postData['proteccion_solar'],
//         $postData['producto_hipoalergenico'],
//         $postData['momento_de_aplicacion'],
//         $postData['tipo_de_piel_id'],
//         $postData['vencimiento'],
//         $postData['precio'],
//         $imagen
//    );



 $dadatina->edit(
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

   (new Alerta())->add_alerta('warning', "Se editaron correctamente los datos");
   header('Location: ../index.php?sec=admin_skin_care');

  } catch (Exception $e) {
    // echo "<pre>";
    // print_r($e->getMessage());
    // echo "<pre>";
    // die("No se pudo editar el Producto =(");


    (new Alerta())->add_alerta('danger', "Ocurrió un error inesperado, por favor pongase en contacto con el administrador de sistema.");
    header('Location: ../index.php?sec=admin_skin_care');
}