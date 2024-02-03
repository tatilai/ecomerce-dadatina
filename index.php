<?PHP 
/*
$misParametros = $_GET;
echo "<pre>";
print_r($misParametros);
echo "</pre>";
*/

  /**array multidimencional para que cuando voy  cada seccion el titulo de la pestaña me CAMBIE 
require_once "classes/Conexion.php";  
require_once "classes/Dadatina.php";
require_once "classes/Uso.php";
require_once "classes/Categoria.php";
require_once "classes/Piel.php";
require_once "classes/Usuario.php";*/

require_once "functions/autoload.php";



$listaPieles=(new Piel())->tipos_pieles();

$listaCategoria=(new Categoria())->tipos_categorias();

//$rangoPrecios=(new Dadatina())->producto_x_precio();
/*echo "<pre>";
print_r($listaPieles);
echo "</pre>";*/



$secciones_validas = [
    "home" => [
        "titulo" => "Bienvenidos",
        "restringido" => FALSE
    ],   
    "contacto" => [
        "titulo" => "contacto",
        "restringido" => FALSE
    ],
    "sobre_mi" => [
        "titulo" => "Sobre mi",
        "restringido" => FALSE
    ], 
    "piel" => [
        "titulo" => "seccion tipos de piel",
        "restringido" => FALSE
    ], 
     "dadatinas" => [
        "titulo" => "dadatina",
        "restringido" => FALSE
    ],
    "producto"=>[
        "titulo" => "Detalle de producto",
        "restringido" => FALSE
    ],
    "catalogo"=>[
        "titulo" => "todos los productos",
        "restringido" => FALSE
    ],
    "testeo"=>[
        "titulo" => "Pagina de testeo",
        "restringido" => FALSE
    ],
    "precios"=>[
        "titulo" => "rango de precios",
        "restringido" => FALSE
    ],
    "carrito"=>[
        "titulo" => "carrito de compras",
        "restringido" => FALSE
    ],
    "login" => [
        "titulo" => "Inicio de Sesión",
        "restringido" => FALSE
    ],
    "panel_usuario" => [
        "titulo" => "Panel de Usuario",
        "restringido" => TRUE
    ],
    "terminar_compra" => [
        "titulo" => "Terminar Compra",
        "restringido" => TRUE
    ]

   
];

    
    
   




$seccion = isset($_GET['sec']) ? $_GET['sec'] : "home";
//$productoSeleccionado = isset($_GET['prod']) ? $_GET['prod'] : FALSE;


if(!array_key_exists($seccion, $secciones_validas)){
    $vista = "404";
    $titulo = "404 - Página no encontrada";
}else{
    $vista = $seccion;


    if($secciones_validas[$seccion]['restringido']){
        (new Autenticacion())->verify(FALSE);        
    }
    

    $titulo = $secciones_validas[$seccion]['titulo'];
}

$userData = $_SESSION['loggedIn'] ?? FALSE;

?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACF BY DADATINA :: <?=$titulo?></title>



   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
   
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>

    <link href="css/style.css" rel="stylesheet">
</head>
<body>


<nav  class="navbar navbar-expand-lg navbar-light bg-gris">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ACF BY DADATINA-Skincare</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?sec=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?sec=catalogo">Catálogo completo</a>

                    </li>


                    <li class="nav-item dropdown">
                  <a class="nav-link btn btn-celeste dropdown-toggle me-3 mb-2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Tipo de producto
                    </a>

                    <ul class="dropdown-menu">
                     <!--<li><a class="dropdown-item" href="index.php?sec=dadatinas&prod=1">Limpieza</a></li>
                     <li><a class="dropdown-item" href="index.php?sec=dadatinas&prod=2">Serums</a></li>
                     <li><a class="dropdown-item" href="index.php?sec=dadatinas&prod=3">Tratamiento</a></li>-->

                       <?php foreach ($listaCategoria as $informacion){?>


                        <li class="dropdown-item"> <a class="nav-link" href="index.php?sec=dadatinas&prod=<?=$informacion['id']?>"><?=$informacion['nombre_categoria']?></a> 

                        </li>


                       <?php }?>
                     </ul>
                   </li>

                   <li class="nav-item dropdown">
                  <a class="nav-link btn btn-celeste dropdown-toggle "  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Tipo de piel
                    </a>

                    <ul class="dropdown-menu">
                     <!--<li><a class="dropdown-item" href="index.php?sec=piel&prod=1">piel normal</a></li>
                     <li><a class="dropdown-item" href="index.php?sec=piel&prod=2">piel mixta</a></li>
                     <li><a class="dropdown-item" href="index.php?sec=piel&prod=3">piel seca</a></li>-->

                       <?php foreach ($listaPieles as $pagina){?>


                        <li class="dropdown-item"> <a class="nav-link" href="index.php?sec=piel&prod=<?=$pagina['id']?>"><?=$pagina['tipo_piel']?></a> 

                        </li>


                        <?php }?>
                                     

                     </ul>
                   </li> 

                <div class="dropdown">  
               
                    <button class="btn btn-celeste  dropdown-toggle  mx-3 mb-2" role="button" id="filtroPrecios" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filtrar por precios
                    </button>
                    <div class="dropdown-menu" aria-labelledby="filtroPrecios">

                      <form action="index.php">
                      <input type="hidden" name="sec" value="precios">
                      <label for="minimo">Precio Min</label>
                      <select class="comboModelos bg-secondary" name="minimo" id="minimo">
                                 <option value="">Seleccione</option>
                                <option value="4000">Hasta $ 4000</option>
                                <option value="5000"> Hasta $ 5000</option>
                                
                                
                      </select>
                      <label for="maximo">Precio Max</label>
                      <select class="comboModelos bg-gris" name="maximo" id="maximo">
                                <option value="">Seleccione</option>
                                <option value="7000">$ 7000</option>
                                <option value="8000">$ 8000</option>
                                
                      </select>
  
                      <button type="submit" class="btn btn-lila">Filtrar</button>



                   </form>
                   </div>
                </div>                 

                        






                   <li class="nav-item">
                        <a class="nav-link btn-lila text-light rounded me-2" href="admin">Admin</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn-amarillo text-light rounded me-2" href="index.php?sec=carrito">🛒 Carrito</a>
                    </li>

                
                    <li class="nav-item <?= $userData ? "d-none" : "" ?>">
                           <a class="nav-link fw-bold " href="index.php?sec=login">Login</a>
                        </li>

                        
                    <?PHP if ($userData) { ?>
                        <li class="nav-item">
                            <a class="nav-link bg-violeta text-light rounded me-2" href="index.php?sec=panel_usuario">🙍​ <?= $userData['username'] ?? "" ?> </a>
                        </li>
                    <?PHP } ?>

                        <li class="nav-item <?= $userData ? "" : "d-none" ?>">
                        <a class="nav-link fw-bold " href="admin/actions/auth_logout.php">Logout <span class="fw-light"></span></a>
                    </li>

                  

                  

                  
                   
                   
                

                    <li class="nav-item">
                        <a class="nav-link <?= $userData ? "d-none" : "" ?>" href="index.php?sec=contacto">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-3 <?= $userData ? "d-none" : "" ?>" href="index.php?sec=sobre_mi">Sobre mí</a>
                    </li>

                                        
                </ul>
            </div>
        </div>
    </nav>

    <main>

    <?PHP 

     //Verifiquemos que el archivo exista.
     require_once file_exists("views/$vista.php") ? "views/$vista.php" : "views/404.php";
    
  /*require_once "views/$seccion.php";*/

    ?>
    </main>

    <footer class="bg-rosa fw-bold text-black text-center">
    © 2023 Materia:
    <p class="fw-bold">Programación 2</p>
    </footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

    
</body>
</html>