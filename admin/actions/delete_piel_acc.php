<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {
    $piel = (new Piel)->piel_x_id($id);
    $piel->delete();
  
    (new Alerta())->add_alerta('success', "Se <strong>eliminó correctamente</strong> el tipo de piel " . $piel-> getTipo_piel());
  
    header('Location: ../index.php?sec=admin_tipo_piel');
} catch (Exception $e) {
    // die("No se pudo eliminar el personaje =(");
    (new Alerta())->add_alerta('danger', "No se puede borrar porque tiene relación con otra tabla,asegurate que no haya dicha relación para poder borralo.");
   header('Location: ../index.php?sec=admin_tipo_piel');
}