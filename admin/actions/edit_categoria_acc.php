<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$id = $_GET['id'] ?? FALSE;


 /*echo "<pre>";
 print_r($postData);
 echo "</pre>";

  echo "<pre>";
  print_r($id);
  echo "</pre>";*/

  try {
    $categoria = (new Categoria)->categoria_x_id($id);
    

   

     $categoria->edit(
    $postData['nombre_categoria']
    
    );
    
    echo "<pre>";
   print_r($categoria);
   echo "</pre>";

   (new Alerta())->add_alerta('warning', "Se <strong>editaron</strong> correctamente los datos");
   header('Location: ../index.php?sec=admin_categorias');
} catch (Exception $e) {
    // echo "<pre>";
    // print_r($e);
    // echo "</pre>";
    // die("No se pudo editar el personaje =(");

    (new Alerta())->add_alerta('danger', "Ocurrió un error inesperado, por favor pongase en contacto con el administrador de sistema.");
    header('Location: ../index.php?sec=admin_categorias');
}
