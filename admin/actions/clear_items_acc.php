<?PHP
require_once "../../functions/autoload.php";


(new Carrito())->limpiar_carrito();
header('location: ../../index.php?sec=carrito');