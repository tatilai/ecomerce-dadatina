<?php

class Ingredientes{


    private $id;
    private $ingredientes;
    private $nombre_ingrediente;



      /**
     * Devuelve el listado completo de los ingredientes en sistema
     */
    public function lista_ingredientes(): array
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM ingredientes";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $lista = $PDOStatement->fetchAll();

        return $lista;
    }


      /**
     * Obtiene el nombre del ingrediente por su ID
     * @param int $idIngrediente El ID del ingrediente
     * @return string|null El nombre del ingrediente o null si no se encuentra
     */
    public function getNombreIngredientePorId(int $id): ?string
    {
        try {
            $conexion = (new Conexion())->getConexion();
            $query = "SELECT nombre_ingrediente FROM ingredientes WHERE id = ?";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
            $PDOStatement->execute([$id]);
    
            $result = $PDOStatement->fetch();
    
            return $result ? $result['nombre_ingrediente'] : null;
        } catch (PDOException $e) {
           
            echo "Error al obtener el nombre del ingrediente: " . $e->getMessage();
            return null;
        }
    }


      /**
    * Devuelve los ingredientes de una crema en particular
   * @param int $id El ID único de la crema
  
      */
  public function ingredientes_x_crema(int $id): ?Ingredientes
  {
   $conexion = Conexion::getConexion();
   $query = "SELECT *FROM ingredientes WHERE id = ?";



   $PDOStatement = $conexion->prepare($query);
   $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
   $PDOStatement->execute([$id]);

        $result = $PDOStatement->fetch();

        return $result ?? null;
  }

     



    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of ingredientes
     */ 
    public function getIngredientes()
    {
        return $this->ingredientes;
    }

    /**
     * Get the value of nombre_ingrediente
     */ 
    public function getNombre_ingrediente()
    {
        return $this->nombre_ingrediente;
    }



    
}