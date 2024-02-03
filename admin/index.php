<?php

/*require_once "../classes/Conexion.php";  
require_once "../classes/Dadatina.php";
require_once "../classes/Uso.php";
require_once "../classes/Categoria.php";
require_once "../classes/Piel.php";
require_once "../classes/Usuario.php";*/

require_once "../functions/autoload.php";

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";


$secciones_validas=[

    "login"=>[
        "titulo"=>"Inicio de sesión",
        "restringido" => FALSE
       ],
   "dashboard"=>[
    "titulo"=>"Panel de Administración",
    "restringido" => TRUE
   ],
    "admin_tipo_piel"=>[
    "titulo" => "Administración de productos",
    "restringido" => TRUE
   ],
   "admin_modo_uso"=>[
    "titulo" => "Administración de productos",
    "restringido" => TRUE
   ],
   "admin_categorias"=>[
    "titulo" => "Administración de productos",
    "restringido" => TRUE
   ],
   "admin_skin_care"=>[
    "titulo" => "Administración de totalidad de productos",
    "restringido" => TRUE
   ],
   "edit_categoria"=>[
    "titulo" => "Editar una categoria",
    "restringido" => TRUE
   ],
   "edit_modo_uso"=>[
    "titulo" => "Editar un modo de uso",
    "restringido" => TRUE
   ],
   "editar_piel"=>[
    "titulo" => "Editar un tipo de piel",
    "restringido" => TRUE
   ],
   "add_tipo_piel"=>[
    "titulo" => "Agregar un tipo de piel",
    "restringido" => TRUE
   ],
   "add_skin_care"=>[
    "titulo" => "Agregar un producto",
    "restringido" => TRUE
   ],
   "edit_piel"=>[
    "titulo" => "Editar un tipo de piel",
    "restringido" => TRUE
   ],
   "edit_skin_care"=>[
    "titulo" => "Editar un producto",
    "restringido" => TRUE
   ],
   "add_categorias"=>[
    "titulo" => "Agregar categoria",
    "restringido" => TRUE
   ],
   "add_uso"=>[
    "titulo" => "Agregar modo de uso",
    "restringido" => TRUE
   ],
   "delete_piel"=>[
    "titulo" => "Eliminar  tipo de piel",
    "restringido" => TRUE
   ],
   "delete_categorias"=>[
    "titulo" => "Eliminar  categoria",
    "restringido" => TRUE
   ],
   "delete_uso"=>[
    "titulo" => "Eliminar  forma de uso",
    "restringido" => TRUE
   ],
   "delete_skin_care"=>[
    "titulo" => "Eliminar producto",
    "restringido" => TRUE
   ]



];

$seccion = isset($_GET['sec']) ? $_GET['sec'] : 'dashboard';

//$seccion=$_GET['sec'] ?? "dashboard";

if(!array_key_exists($seccion, $secciones_validas)){
   $vista = "404";
   $titulo = "404 - Página no encontrada";
}else{
   $vista = $seccion;

   if($secciones_validas[$seccion]['restringido']){
    (new Autenticacion())->verify();    
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
    <title>ACF BY DADATINA  :: <?= $titulo; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-violeta">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">Panel de Administración</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>                
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active <?= $userData ? "" : "d-none" ?>"  href="index.php?sec=dashboard">Dashboard</a>
                    </li>
                     <li><a class="nav-link text-blanco" href="../index.php?sec=home"> Tienda</a> </li>                    
                    <li><a class="nav-link active <?= $userData ? "" : "d-none" ?> " href="index.php?sec=admin_skin_care">Administrar skin care</a></li>

                   <li><a class="nav-link active <?= $userData ? "" : "d-none" ?>" href="index.php?sec=admin_tipo_piel">Administrar tipo de piel</a></li>
                  <li><a class="nav-link active <?= $userData ? "" : "d-none" ?>" href="index.php?sec=admin_categorias">Administrar categoria</a></li>
                  <li><a class="nav-link active <?= $userData ? "" : "d-none" ?>" href="index.php?sec=admin_modo_uso">Administrar modo de uso</a></li>

                          <li class="nav-item <?= $userData ? "d-none" : "" ?>">
                           <a class="nav-link fw-bold <?= $userData ? "" : "d-none" ?>" href="index.php?sec=login">Login</a>
                        </li>

                    <li class="nav-item ">
                        <a class="nav-link fw-bold <?= $userData ? "" : "d-none" ?>" href="actions/auth_logout.php">Logout: <span class="fw-light"><?= $userData['username'] ?? "" ?></span></a>
                    </li>

                
                </ul>
                 
            </div>
        </div>
    </nav>
    <main class="container">

        <?PHP
        require file_exists("views/$vista.php") ? "views/$vista.php" : "views/404.php";
        ?>

    </main>
    <footer class="bg-rosa fw-bold text-black text-center">
    © 2023 Materia:
    <p class="fw-bold">Programación 2</p>
    </footer>
</body>

</html>