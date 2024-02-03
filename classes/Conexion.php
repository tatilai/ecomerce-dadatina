<?PHP

/**
 * Clase para proveer la conexion de PDO al proyecto
 */
class Conexion{

    private const  DB_SERVER = "localhost";
    //const DB_SERVER ="127.0.0.1";
    private const DB_USER ="root";
    private const DB_PASS = "";
    private const DB_NAME ="prog2_dadatina_ini";

    private const DB_DSN ="mysql:host=". self::DB_SERVER.";dbname=". self::DB_NAME.";charset-utf8mb4";

    private static ?PDO $db = null;

    public static function conectar()
    {
        try{
            self::$db= NEW PDO(self::DB_DSN,self::DB_USER, self::DB_PASS);
        }catch(Exception $e){ 
               
            die('Error al conectar con MySQL');
        }
    }


    /**
     * Metodo que devuelve una conexion PDO  lista para usar
     * @return PDO
     */
    public static function getConexion(): PDO
    {
        if(self::$db === null){
            self::conectar();

        }
        return self::$db;
    }


}