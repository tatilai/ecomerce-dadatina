<?php
class Dadatina
{

    private $id;    
    private $categoria;
    private $titulo;
    private $producto;
    private $contenido_neto;
    private $modo_de_uso; 
    private $proteccion_solar;
    private $producto_hipoalergenico;
    private $momento_de_aplicacion;
    private $tipo_de_piel;
    private $imagen;
    private $vencimiento;
    private $ingredientes;
    private $precio; 
    

    private static $createValues = ['id',  'titulo', 'producto', 'contenido_neto', 'proteccion_solar', 'producto_hipoalergenico', 'momento_de_aplicacion', 'imagen','vencimiento','precio'];

    
    /**
     * Devuelve una instancia del objeto Dadatina, con todas sus propiedades configuradas
     *@return Dadatina
     */
    private function createDadatina($dadatinaData): Dadatina
    {
        /* echo "<pre>";
         print_r($dadatinaData);
         echo "</pre>";*/


        $dadatina = new self();


        /*ACÁ TENEMOS QUE CONFIGURAR NUESTRO OBJETO */
        /*Primero, por cada valor en nuestro array de valores, buscamos el valor correspondiente y se lo asignamos a la propiedad*/
        foreach (self::$createValues as $value) {
            $dadatina->{$value} = $dadatinaData[$value];
        }

          /* Vamos a crear un objeto Categoria con los datos correspondientes y lo asignamos a la propiedad */
          $dadatina->categoria=(new Categoria())->categoria_x_id($dadatinaData['categoria_id']);
          /*$categoria=(new Categoria())->categoria_x_id($dadatinaData['categoria_id']);*/

          
          /* Vamos a crear un objeto Modo de uso con los datos correspondientes y lo asignamos a la propiedad */
          $dadatina->modo_de_uso=(new Uso())->modo_x_uso($dadatinaData['modo_de_uso_id']);
          
          /* Vamos a crear un objeto Tipo piel con los datos correspondientes y lo asignamos a la propiedad */
          $dadatina->tipo_de_piel=(new Piel())->piel_x_id($dadatinaData['tipo_de_piel_id']);


          /* Vamos a asignar los ingredientes a la propiedad */
          $ingredIds = !empty($dadatinaData['ingredientes']) ? explode(",", $dadatinaData['ingredientes']) : [];

          $ingredientes = [];
          foreach ($ingredIds  as $ingredIds ) {
            $ingredientes[] = (new Ingredientes())->ingredientes_x_crema(intval($ingredIds));

          //$ingredientes[] = $this->get_x_id(intval($ingredIds));

           /*echo "<pre>";
            print_r($ingredientes);
            echo "</pre>";*/


          // $dadatina->ingredientes=(new Piel())->piel_x_id($dadatinaData['ingredientes_id']);


          }

        $dadatina->ingredientes=$ingredientes;


      
     

        return $dadatina;
    }

     /**
     * Devuelve el catalogo completo 
     * @return Dadatina[] Un array lleno de instancias del objeto dadatina
     */
    public function catalogo_completo():array{
       
        
        $catalogo = [];
        
        $conexion = Conexion::getConexion();
        //$query = "SELECT* FROM dadatina";
        $query="SELECT dadatina. *,GROUP_CONCAT(ixp.ingredientes_id) AS ingredientes FROM dadatina
        LEFT JOIN dadatina_x_ingredientes AS ixp ON dadatina.id = ixp.dadatina_id
        GROUP BY dadatina.id";

        $PDOstatement = $conexion->prepare($query);
        $PDOstatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOstatement->execute();

        /* $catalogo=$PDOstatement->fetchAll();
         
         echo "<pre>";
         print_r($catalogo);
         echo "</pre>";*/

         while($result =$PDOstatement->fetch()){
            $catalogo[]=$this->createDadatina($result);
         }

        



         
         return $catalogo;



        
    }


   /**
   * Devuelve el catalogo de productos de una categoria en particular
   * @param string $categoria un string con el nombre de la categoria a buscar
   * 
   * @return Dadatina[] Un array lleno de instancias del objeto dadatina
   */
  function catalogo_categoria(int $categoria_id):array{
    
    $catalogo = [];
    $conexion = Conexion::getConexion();
   // $query = "SELECT * FROM dadatina WHERE categoria_id = ?";

    $query=" SELECT dadatina.*, GROUP_CONCAT(dxi.ingredientes_Id) AS ingredientes
    FROM dadatina
    LEFT JOIN dadatina_x_ingredientes AS dxi ON dadatina.id = dxi.dadatina_id
    WHERE dadatina.categoria_id = ?
    GROUP BY dadatina.id";


    $PDOstatement = $conexion->prepare($query);
    $PDOstatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOstatement->execute(
        [$categoria_id]
    );

 
    while($result =$PDOstatement->fetch()){
        $catalogo[]=$this->createDadatina($result);
     }


     return $catalogo;
  }




    /**
   *Devuelve el catalogo de productos de una categoria de piel en particular
   * @param int $tipo_de_piel un int con el id del producto para un tipo de piel en particular a buscar
   * 
   * @return Dadatina[] Un array lleno de instancias del objeto dadatina
   */
  function piel(int $tipo_de_piel_id):array{
      
   // $catalogo = [];

    $conexion = Conexion::getConexion();
    $query = "SELECT * FROM dadatina WHERE tipo_de_piel_id =?";

    $PDOstatement = $conexion->prepare($query);
    $PDOstatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOstatement->execute(
        [ $tipo_de_piel_id]
    );

    while($result =$PDOstatement->fetch()){
        $catalogo[]=$this->createDadatina($result);
     }

     //$catalogo=$PDOstatement->fetchAll();
     return $catalogo;
   






  }

  /**
   * Devuelve los productos en un determinado rango de precios
   * @param int $minimo el precio minimo.De no proveerla se asumiria 0
   * @param int $maximo El precio maximo,de no proveerlo se asumira infinito
   * 
   * @return Dadatina[] un array de objetos Dadatina
   */
 public function producto_x_precio(int $minimo =0,int $maximo= 0){
    
    $conexion = Conexion::getConexion();
    if($maximo){
        /*precios entre min y max */
        $query="SELECT*FROM dadatina where precio between :minimo and :maximo;";

        $valores=[
            'minimo'=>$minimo,
            'maximo'=>$maximo 
        ];
    }else{

        /*precios mayores a min */
        $query="SELECT*FROM dadatina where precio > :minimo;";

        $valores=[
            'minimo'=>$minimo,
                       
        ];
    }

    $PDOstatement = $conexion->prepare($query);
   //$PDOstatement->setFetchMode(PDO::FETCH_CLASS,self::class);
   $PDOstatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOstatement->execute($valores);

    while($result =$PDOstatement->fetch()){
        $catalogo[]=$this->createDadatina($result);
     }
        

   // while($result =$PDOstatement->fetch()){
       // $catalogo[]=$this->createDadatina($result);
     //}
  //  $catalogo=$PDOstatement->fetchAll();

    return $catalogo;
  }


    /**
 * Devuelve los datos de un producto en particular 
 * @param int $idProducto el id único del producto a mostrar
 * 
 * @return ?Dadatina devuelve un objeto dadatina o null
 */
 function producto_x_identificacion(int $idProducto):?Dadatina{

    $conexion = Conexion::getConexion();
   // $query = "SELECT * FROM dadatina WHERE id=?";

   

    $query="SELECT dadatina. *,GROUP_CONCAT(ixp.ingredientes_id) AS ingredientes FROM dadatina
    LEFT JOIN dadatina_x_ingredientes AS ixp ON dadatina.id = ixp.dadatina_id
    WHERE dadatina.id =?
    GROUP BY dadatina.id";
  
    
    $PDOstatement = $conexion->prepare($query);
    $PDOstatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOstatement->execute([$idProducto]);
  
    $result = $this->createDadatina($PDOstatement->fetch());
  
    return $result ?? null;


   // $result = $PDOstatement->fetch();
    //var_dump($result);

    // if ($result) {
    //     $dadatina = $this->createDadatina($result);

      
    //     $ingredientes = $this->ingredientes_x_crema($idProducto);

       
    //     $dadatina->ingredientes = $ingredientes;

    //     return $dadatina;
    // }

    // return null;
  
    
  }

 


    /**
     * Inserta un nuevo producto a la base de datos
     * @param string $titulo
     * @param int $categoria_id
     * @param string $producto
     *  @param int $contenido_neto
     * @param int $modo_de_uso_id
     * @param string $proteccion_solar
     * @param string $producto_hipoalergenico
     *  @param string $momento_de_aplicacion
     * @param int $tipo_de_piel_id
     *@param string $imagen ruta a un archivo .jpg o .png       
     * @param string $vencimiento fecha de vencimiento en formato YYYY-MM-DD
     *@param float $precio  
    */
    public function insert($titulo, $categoria_id,$producto,$contenido_neto, $modo_de_uso_id,$proteccion_solar,$producto_hipoalergenico,$momento_de_aplicacion,$tipo_de_piel_id,$imagen,$vencimiento,$precio):int
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO dadatina VALUES (NULL, :titulo, :categoria_id, :producto, :contenido_neto, :modo_de_uso_id, :proteccion_solar, :producto_hipoalergenico, :momento_de_aplicacion, :tipo_de_piel_id, :imagen, :vencimiento,:precio)";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'titulo' => $titulo,
                'categoria_id' => $categoria_id,
                'producto' => $producto,
                'contenido_neto' => $contenido_neto,
                'modo_de_uso_id' => $modo_de_uso_id,
                'proteccion_solar' => $proteccion_solar,
                'producto_hipoalergenico' => $producto_hipoalergenico,
                'momento_de_aplicacion' => $momento_de_aplicacion,
                'tipo_de_piel_id' => $tipo_de_piel_id,
                'imagen' => $imagen,
                'vencimiento' => $vencimiento,
                'precio' => $precio,
            ]
        );

        return $conexion->lastInsertId();
    }

    /**
    * Edita una instancia de la base de datos
    */
    public function edit($titulo, $categoria_id, $producto, $contenido_neto, $modo_de_uso_id, $proteccion_solar, $producto_hipoalergenico, $momento_de_aplicacion, $tipo_de_piel_id, $imagen, $vencimiento, $precio)
    {

        $conexion = Conexion::getConexion();
        $query = "UPDATE dadatina SET
         titulo = :titulo,
         categoria_id = :categoria_id,
         producto = :producto,
         contenido_neto = :contenido_neto,
         modo_de_uso_id = :modo_de_uso_id,
         proteccion_solar = :proteccion_solar,
         producto_hipoalergenico = :producto_hipoalergenico,
         momento_de_aplicacion = :momento_de_aplicacion,
         tipo_de_piel_id = :tipo_de_piel_id,
         imagen = :imagen,
         vencimiento = :vencimiento,
         precio = :precio
               
        WHERE id = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id' => $this->id,
                'titulo' => $titulo,
                'categoria_id'=> $categoria_id,
                'producto' => $producto,
                'contenido_neto' => $contenido_neto,
                'modo_de_uso_id' => $modo_de_uso_id,
                'proteccion_solar' => $proteccion_solar,
                'producto_hipoalergenico' => $producto_hipoalergenico,
                'momento_de_aplicacion' => $momento_de_aplicacion,
                'tipo_de_piel_id' => $tipo_de_piel_id,
                'imagen' => $imagen,
                'vencimiento' => $vencimiento,
                'precio' => $precio,
                      
            ]
        );
    }

       /**
     * Crea un vinculo entre un producto dadatina y un ingrediente
     * @param int $dadatina_id
     * @param int $ingredientes_id
     */
    public function add_ingredientes_dadatina(int $dadatina_id, int $ingredientes_id)
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO dadatina_x_ingredientes VALUES (NULL, :dadatina_id, :ingredientes_id)";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'dadatina_id' => $dadatina_id,
                'ingredientes_id' => $ingredientes_id
            ]
        );
    }


      /**
     * Vaciar lista de ingredientes
     * @param int $dadatina_id
     */
    public function clear_cremas()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM dadatina_x_ingredientes WHERE dadatina_id = :dadatina_id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'dadatina_id' => $this->id
            ]
        );
    }

        /**
     * Elimina esta instancia de la base de datos
     */
    public function delete()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM dadatina WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }


  

   /**
    * Devuelve el prodBuscador
    */
     function buscador(string $terminoBusqueda):Array{

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM dadatina WHERE titulo LIKE :termino";
      
        
        $PDOstatement = $conexion->prepare($query);
        $PDOstatement->setFetchMode(PDO::FETCH_CLASS,self::class);
        $PDOstatement->execute(['termino'=>"%$terminoBusqueda%"]);
      
        $catalogo = $PDOstatement->fetchAll();
      
        return $catalogo;
        




    } 



    /**Devuelve el nombre completo de la edicion */
     function nombre_completo():string{
        return $this->getCategoria(). " Cont.Net."
      . $this->getContenidoNeto() . "#" . $this->getTipoDePiel();

    }


    /**
     * Devuelve el precio de la unidad formateado correctamente
     */
     function precio_nuevo():string{

      return number_format($this->precio,2, ",", ".");
    }

   /**
   * Esta función devuelve la cantidad de palabras que le indiquemos a un párrafo
   * @param int $cantidad Esta es la cantidad de palabras a extraer (Opcional)
   *    
   */
    function igualar_palabras(int $cantidad = 10):string{
    
    $texto = $this->getModoDeUso();

        $array = explode(" ", $texto);
        if (count($array) <= $cantidad) {
            $resultado = $texto;
        } else {
            array_splice($array, $cantidad);
            $resultado = implode(" ", $array) . "...";
        }

        return $resultado;

  
  
  }

  /**
     * Get the value of categoria
     */ 
    public function getCategoria()
    {


        return $this->categoria->getNombre_categoria();

        
    }

    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Get the value of producto
     */ 
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Get the value of numero
     */ 
    public function getContenidoNeto()
    {
        return $this->contenido_neto;
    }

    /**
     * Get the value of modo de uso
     */ 
    public function getModoDeUso()
    {
        

        return $this->modo_de_uso->getForma_de_aplicacion();
    }

    /**
     * Get the value of proteccion solar
     */ 
    public function getProteccionSolar()
    {
        return $this->proteccion_solar;
    }

    /**
     * Get the value of producto hipoalergenico
     */ 
    public function getProductoHipoalergenico()
    {
        return $this->producto_hipoalergenico;
    }

    /**
     * Get the value of momento de aplicacion
     */ 
    public function getMomentoDeAplicacion()
    {
        return $this->momento_de_aplicacion;
    }



    /**
     * Get the value of tipo de piel
     */ 
    public function getTipoDePiel()
    {
       return $this->tipo_de_piel->getTipo_piel();
    }
      

     /**
     * Get the value of imagen
     */ 
    public function getImagen()
    {
        return $this->imagen;
    }
      


    /**
     * Get the value of fecha de vencimiento
     */ 
    public function getFechaDeVencimiento()
    {
        return $this->vencimiento;
    }
  
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

   

    public function __construct()
   {
    $this->ingredientes = new Ingredientes();
   }
    

    /**
     * Get the value of ingredientes
     */ 
    public function getIngredientes()
    {
        return $this->ingredientes;
    }


 

  



   

    

    /**
     * Get the value of ingredientes
     */ 
//    public function getIngredientes()
//     {
//         {
//             $nombresIngredientes = [];
            
//             foreach ($this->ingredientes as $ingrediente) {
//                 $nombresIngredientes[] = $ingrediente->getNombre_ingrediente();
//             }
        
//             return $nombresIngredientes;
//         };
//     }



    


    /**
     * Devuelve un array compuesto por IDs de todos los ingredientes
     */
    public function getIngredientes_ids(): array
    {
        $result = [];
        foreach ($this->ingredientes as $value) {
            $result[intval($value->getId())] = $value;
        }
        return $result;
    }

     /**
     * Devuelve un array compuesto por IDs de todos los ingredientes
     */
    // public function getIngredientes_ids(): array
    // {
    //     $result = [];
    //     foreach ($this->ingredientes as $value) {
    //         $result[] = intval($value->getId());
    //     }
    //     return $result;
    // }


  
    
  



   
}