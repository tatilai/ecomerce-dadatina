<?php
 echo "<pre>";
print_r($_GET);
echo "</pre>"; 


$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$telefono= $_GET['tel'];
$email=$_GET['email'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACF BY DADATINA :: <?=$titulo?></title>


   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
   

    <link href="../css/style.css" rel="stylesheet">
</head>
<body>



<div class="container bg-rosita">
    <div class="row"> 
        <div class="col">
            <h1 class="col-12 text-center mt-3 text-lavanda">Resultado de los datos ingresados</h1>
            <div class="">                
                <ul class="list-unstyled mx-3">
                <li class="text-lavanda" style="font-weight:bold"> <img class="check" src="../img/iconografia/check.png" alt="icono de check"> El  nombre es: <?=$nombre?> </li>
                <li class="text-lavanda" style="font-weight:bold">  <img class="check2" src="../img/iconografia/check.png" alt="icono de check"> El  apellido es: <?= $apellido?> </li>
                <li class="text-lavanda" style="font-weight:bold">  <img class="check3" src="../img/iconografia/check.png" alt="icono de check"> El telefono es: <?= $telefono?> </li>
                <li class="text-lavanda" style="font-weight:bold">  <img src="../img/iconografia/check.png" alt="icono de check"> El correo electrónico  es: <?=$email?></li>
               </ul>
             </div>            
        </div>
    </div>
</div>
  
 
 
</body>
</html>






