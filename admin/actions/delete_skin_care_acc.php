<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;


try {

    $dadatina = (new Dadatina())->producto_x_identificacion($id);

    (new Imagen())->borrarImagen(__DIR__ . "/../../img/cremas/" . $dadatina->getimagen());
    $dadatina->clear_cremas();
    $dadatina->delete();
    
  
    (new Alerta())->add_alerta('success', "Se <strong>eliminó correctamente</strong> el producto " . $dadatina->getProducto());
    header('Location: ../index.php?sec=admin_skin_care');

}catch (Exception $e) {
    //  echo "<pre>";
    //  print_r($e->getMessage());
    //  echo "<pre>";
    //  die("No se pudo eliminar el Comic =(");
    (new Alerta())->add_alerta('danger', "No se puede borrar porque tiene relación con otra tabla,asegurate que no haya dicha relación para poder elimiralo.");
    header('Location: ../index.php?sec=admin_skin_care');
}