<?php

class Piel{
    
    private $id;
    private $tipo_piel;


      /**
     * Devuelve el listado completo de tipo de pieles en sistema
     */
    public function lista_pieles(): array
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM piel";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $lista = $PDOStatement->fetchAll();

        return $lista;
    }

    /**
     * Devuelve un array con los nombres y IDS de todos los productos que pertenen a una categoria de piel existenete en nuestro catalogo
     */
     public function tipos_pieles():array{

        $conexion= Conexion::getConexion();

     $query= "SELECT DISTINCT
              piel.id,
              piel.tipo_piel

             FROM dadatina
             JOIN piel on dadatina.tipo_de_piel_id=piel.id;";

       $PDOstatement = $conexion->prepare($query);
       $PDOstatement->setFetchMode(PDO::FETCH_ASSOC);
       $PDOstatement->execute();
       
       $lista =$PDOstatement->fetchAll();


        return $lista;
    }

        /**
 * Devuelve los datos de un producto que pertenece a un tipo de piel en particular 
 * @param int $id el id único del producto a mostrar
 */
 function piel_x_id(int $id):?Piel{

    $conexion = (new Conexion())->getConexion();
    $query = "SELECT * FROM piel WHERE id=?";
  
    
    $PDOstatement = $conexion->prepare($query);
    $PDOstatement->setFetchMode(PDO::FETCH_CLASS,self::class);
    $PDOstatement->execute(
        [$id]
    );
  
    $result = $PDOstatement->fetch();
  
    return $result ?? null;
  
    
  }
  


  /**
   * Inserta un nuevo tipo de piel a la base de datos
   * @param string $tipo_piel
   * @param int $id
   */
  public function insert(?string $tipo_piel)
  {
    try{
     $conexion=Conexion::getConexion();
     //$conexion = (new Conexion())->getConexion();
     $query= "INSERT INTO piel (`tipo_piel`) VALUES (:tipo_piel)";

     $PDOStatement = $conexion->prepare($query);
     $PDOStatement->execute([
      'tipo_piel'=>$tipo_piel  
      ]);
    }catch (PDOException $e) {
      // Manejar el error de la base de datos
      echo "Error en la inserción: " . $e->getMessage();
      }
    

  }


  /**
     * Edita los datos de un tipo de piel en la base de datos
     * @param string $nombre     
     */
    public function editar($tipo_piel)
    {
          

        $conexion = Conexion::getConexion();
        $query = "UPDATE piel SET tipo_piel = :tipo_piel WHERE id = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id' => $this->id,
                'tipo_piel' => $tipo_piel
                
            ]
        );
    }
    

         /**
     * Elimina esta instancia de la base de datos
     */
    public function delete()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM piel WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }
    

   

    


    /**
     * Get the value of tipo_piel
     */ 
    public function getTipo_piel()
    {
        return $this->tipo_piel;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }


}
