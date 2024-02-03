 <?PHP 

 class Categoria{

    private $id;
    private $nombre_categoria;




    


    
      /**
     * Devuelve el listado completo de categorias de productos en sistema
     */
    public function lista_categorias(): array
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM categoria";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $lista = $PDOStatement->fetchAll();

        return $lista;
    }

    /**
     * Devuelve un array con los nombres y IDS de todos los productos que pertenen a una categoria de producto existenete en nuestro catalogo
     */
    public function tipos_categorias():array{

      $conexion= Conexion::getConexion();

   $query= "SELECT DISTINCT
            categoria.id,
            categoria.nombre_categoria

           FROM dadatina
           JOIN categoria on dadatina.categoria_id=categoria.id;";

     $PDOstatement = $conexion->prepare($query);
     $PDOstatement->setFetchMode(PDO::FETCH_ASSOC);
     $PDOstatement->execute();
     
     $lista =$PDOstatement->fetchAll();


      return $lista;
  }



     /**
   * Devuelve los datos de una categoria   en particular 
   * @param int $id el id único de la categoria a mostrar
   */
   function categoria_x_id(int $id):?Categoria{

    $conexion = (new Conexion())->getConexion();
    $query = "SELECT * FROM categoria WHERE id=?";
  
    
    $PDOstatement = $conexion->prepare($query);
    $PDOstatement->setFetchMode(PDO::FETCH_CLASS,self::class);
    $PDOstatement->execute(
        [$id]
    );
  
    $result = $PDOstatement->fetch();
  
    return $result ?? null;
  
    
  }

    /**
   * Inserta un nuevo tipo de categoria a la base de datos
   * @param string $nombre_categoria
   * @param int $id
   */
  public function insertar(?string $nombre_categoria)
  {
    try{
     $conexion=Conexion::getConexion();
     //$conexion = (new Conexion())->getConexion();
     $query= "INSERT INTO categoria (`nombre_categoria`) VALUES (:nombre_categoria)";

     $PDOStatement = $conexion->prepare($query);
     $PDOStatement->execute([
      'nombre_categoria'=>$nombre_categoria  
      ]);
    }catch (PDOException $e) {
      // Manejar el error de la base de datos
      echo "Error en la inserción: " . $e->getMessage();
      }
    

  }

   /**
     * Edita los datos de una categoria en la base de datos
     * @param string $nombre     
     */
    public function edit($nombre_categoria)
    {
          

        $conexion = Conexion::getConexion();
        $query = "UPDATE categoria SET nombre_categoria = :nombre_categoria WHERE id = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id' => $this->id,
                'nombre_categoria' => $nombre_categoria
                
            ]
        );
    }



        /**
     * Elimina esta instancia de la base de datos
     */
    public function delete()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM categoria WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }
    


    
  
    

    /**
     * Get the value of categoria
     */ 
    public function getCategoria()
    {
        return $this->nombre_categoria;
    }
    

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of nombre_categoria
     */ 
    public function getNombre_categoria()
    {
        return $this->nombre_categoria;
    }






    
 }
