<?php
class Carrito{
    /**
     * Agrega un item al carrito de compras
     * @param int $productoID el ID del producto que se va agregar
     * @param int $cantidad la cantidad de unidades del producto que se va a agregar
     */
    public function agregar_item(int $productoID, int $cantidad){
        $itemData=(new Dadatina)->producto_x_identificacion($productoID);



        /*echo "<pre>";
        echo"<p>holaaaa</p>";
        print_r($itemData);
        echo "</pre>";*/
       
        if($itemData){
            $_SESSION['carrito'][$productoID]=[

                'producto'=>$itemData->nombre_completo(),
                'titulo'=>$itemData->getTitulo(),
                'imagen'=>$itemData->getImagen(),
                'precio'=>$itemData->getPrecio(),
                'cantidad'=>$cantidad

            ];
        }

      /*  echo "<pre>";
        print_r($_SESSION['carrito'] ?? "");
        echo "</pre>";*/
        
    }


    /**
     * Elimina un item del carrito de compras
     * @param int $productoID el id del producto a eliminar
     */
    public function eliminar_item(int $productoID)
    {

        if (isset($_SESSION['carrito'][$productoID])){
            unset($_SESSION['carrito'][$productoID]);
        }
    }

    /**
     * Vacía el carrito de compras
     */
    public function limpiar_carrito()
    {

        $_SESSION['carrito']= [];
    }




 
    /**
     * Devuelve el contenido del carrito de compras actual
     */
    public function get_carrito(): array{
       /* echo"<p>tatiana laila ramirez</p>";
        echo "<pre>";
        print_r($_SESSION['carrito'] ?? "");
        echo "</pre>";
        die("holaaa");*/
        if(!empty($_SESSION['carrito'])){
            return $_SESSION['carrito'];
        }else{
            return[];
        }
    }



    
    /**
     * Actualiza las cantidades de los ids provistos
     * @param array $cantidades Array asociativo con las cantidades de cada ID
     */
    public function actualizar_cantidades(array $cantidades)
    {
        foreach ($cantidades as $key => $value) {
            if (isset($_SESSION['carrito'][$key])) {
                $_SESSION['carrito'][$key]['cantidad'] = $value;
            }
        }
    }



     /**
     * Devuelve el precio total actual del carrito de compras
     */
    public function precio_total(): float
    {
        $total = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }
        }
        return $total;
    }

}