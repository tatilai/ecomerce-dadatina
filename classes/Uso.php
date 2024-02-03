<?PHP

class Uso{
    private $id;
    private $forma_de_aplicacion;
   


     /**
     * Devuelve el listado completo de formas de uso de las cremas
     */
    public function lista_usos(): array
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM modo_de_uso_id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $lista = $PDOStatement->fetchAll();

        return $lista;
    }

     /**
 * Devuelve los datos de un modo de uso  en particular 
 * @param int $id el id único del modo de udo a ejecutar
 */
function modo_x_uso(int $id):?Uso{

    $conexion = Conexion::getConexion();
    $query = "SELECT * FROM modo_de_uso_id WHERE id=?";
  
    
    $PDOstatement = $conexion->prepare($query);
    $PDOstatement->setFetchMode(PDO::FETCH_CLASS,self::class);
    $PDOstatement->execute(
        [$id]
    );
  
    $result = $PDOstatement->fetch();
  
    return $result ?? null;
  
    
  }
  

   /**
   * Inserta una nueva forma de uso a la base de datos
   * @param string $forma_de_uso
   * @param int $id
   */
  public function incrustar(?string $forma_de_aplicacion)
  {
    try{
     $conexion=Conexion::getConexion();
     //$conexion = (new Conexion())->getConexion();
     $query= "INSERT INTO modo_de_uso_id (`forma_de_aplicacion`) VALUES (:forma_de_aplicacion)";

     $PDOStatement = $conexion->prepare($query);
     $PDOStatement->execute([
      'forma_de_aplicacion'=>$forma_de_aplicacion
      ]);
    }catch (PDOException $e) {
      // Manejar el error de la base de datos
      echo "Error en la inserción: " . $e->getMessage();
      }
    

  }

  /**
     * Edita los datos de las formas de uso en la base de datos
     * @param string $nombre     
     */
    public function editando($forma_de_aplicacion)
    {
          

        $conexion = Conexion::getConexion();
        $query = "UPDATE modo_de_uso_id SET forma_de_aplicacion = :forma_de_aplicacion WHERE id = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id' => $this->id,
                'forma_de_aplicacion' => $forma_de_aplicacion
                
            ]
        );
    }

            /**
     * Elimina esta instancia de la base de datos
     */
    public function delete()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM modo_de_uso_id WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }
    
    

    

    /**
     * Get the value of forma_de_aplicacion
     */ 
    public function getForma_de_aplicacion()
    {
        return $this->forma_de_aplicacion;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

}


