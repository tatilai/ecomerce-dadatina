<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

try {
    $categoriasDos = (new Categoria)->categoria_x_id($id);
    $categoriasDos->delete();

    (new Alerta())->add_alerta('success', "Se <strong>eliminó correctamente</strong> la categoria " . $categoriasDos-> getNombre_categoria());

    header('Location: ../index.php?sec=admin_categorias');
} catch (Exception $e) {
    // die("No se pudo eliminar el personaje =(");
    (new Alerta())->add_alerta('danger', "No se puede borrar porque tiene relación con otra tabla,asegurate que no haya dicha relación para poder borralo.");
   header('Location: ../index.php?sec=admin_categorias');
}