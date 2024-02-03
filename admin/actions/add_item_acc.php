<?php
require_once "../../functions/autoload.php";

$id = $_GET ['id'] ?? FALSE;
$q = $_GET['q'] ?? 1;


if($id){
    (new Carrito())->agregar_item($id,$q);
    header('location: ../../index.php?sec=carrito');
}