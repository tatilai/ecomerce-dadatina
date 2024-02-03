<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;

if($id){
    (new Carrito())->eliminar_item($id);
    header('location: ../../index.php?sec=carrito');
}