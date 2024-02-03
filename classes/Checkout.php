<?php

class Checkout{
    
    /**
     * Inserta los datos de una compra en la BBDD
     * @param array $checkoutData Array con los datos de la compra
     * @param array $detailsData Array con los productos incluidos en la compra
     */
     public function insert_checkout_data(array $checkoutData, array $detailsData)
     {

        $conexion = Conexion::getConexion();
        $query = "INSERT INTO compras VALUES (NULL, :id_usuario, :fecha, :importe)";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            "id_usuario" => $checkoutData['id_usuario'], 
            "fecha" => $checkoutData['fecha'], 
            "importe" => $checkoutData['importe']
        ]);


        $isertedID = $conexion->lastInsertId();


        foreach ($detailsData as $key => $value) {
            $query = "INSERT INTO item_x_compra VALUES (NULL, :compra_id, :item_id, :cantidad)";
        
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([
                "compra_id" => $isertedID, 
                "item_id" => $key, 
                "cantidad" => $value
            ]);
        }

     }

}