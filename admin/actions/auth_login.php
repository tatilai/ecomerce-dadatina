<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;

           echo "<pre>";
         print_r($postData);
         echo "</pre>";

$login = (new Autenticacion())->log_in($postData['nombre_usuario'], $postData['pass']);

if ($login) {

    if($login == "usuario"){ 
        header('location: ../../index.php?sec=panel_usuario');
    }else{
        header('location: ../index.php?sec=dashboard');
    }
    
} else {
    header('location: ../index.php?sec=login');
}

