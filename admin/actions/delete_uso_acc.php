<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {
    $uso = (new Uso)->modo_x_uso($id);
    $uso->delete();
   /* if (!empty($personaje->getImagen())) {
        (new Imagen())->borrarImagen(__DIR__ . "/../../img/personajes/" . $personaje->getImagen());
    }*/
    
   
    (new Alerta())->add_alerta('success', "Se <strong>eliminó correctamente</strong> la categoria " . $uso->getForma_de_aplicacion());
    header('Location: ../index.php?sec=admin_modo_uso');
} catch (Exception $e) {
    // die("No se pudo eliminar el personaje =(");
    (new Alerta())->add_alerta('danger', "No se puede borrar porque tiene relación con otra tabla,asegurate que no haya dicha relación para poder eliminarlo.");
    header('Location: ../index.php?sec=admin_modo_uso');
}