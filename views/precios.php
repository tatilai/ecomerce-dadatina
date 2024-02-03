<?php
$pMin = isset($_GET['minimo']) ?(int)$_GET['minimo'] : 0;
$pMax = isset($_GET['maximo']) ? (int)$_GET['maximo'] : 0;


// Validar que los valores sean numéricos
if (!is_numeric($pMin) || !is_numeric($pMax)) {
    
    die("Error: Los valores de minimo y maximo deben ser numéricos.");
}



$precios = (new Dadatina())->producto_x_precio($pMin, $pMax);



// echo"<pre>";
// print_r($precios);
// echo "</pre>";


?>

<div class=" d-flex justify-content-center p-5 bg-rosita">
    <div>
        <h1 class="text-center mb-5 fw-bold">Nuestro filtro de precios</h1>

        <div class="container">

            <?php if(!empty($precios)){ ?>
            <div class="row"> 

            
             
                <?PHP foreach ($precios as $dadatina) { ?>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div  class="card border border-warning mb-3 bg-crema">
                            <img src="img/cremas/<?= $dadatina->getImagen() ?>" class="card-img-top" alt="Portada de <?= $dadatina->nombre_completo() ?>">
                            <div class="card-body" style="height:15rem">
                                <p class="fs-6 m-0 fw-bold text-lila"><?= $dadatina->nombre_completo() ?></p>
                                <h2 class="card-title "><?= $dadatina->getTitulo() ?></h2>
                                <p class="card-text"><?=$dadatina->igualar_palabras()?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><span class="fw-bold text-lila">Protección solar:</span> <?= $dadatina->getProteccionSolar() ?></li>
                                <li class="list-group-item"><span class="fw-bold text-lila">Producto hipoalergénico:</span> <?= $dadatina->getProductoHipoalergenico() ?></li>
                                <li class="list-group-item"><span class="fw-bold text-lila">Momento de aplicación:</span> <?= $dadatina->getMomentoDeAplicacion() ?></li>
                            </ul>
                            <div class="card-body">
                                <div class="fs-3 mb-3 fw-bold text-center text-lavanda">$<?=$dadatina->precio_nuevo()?></div>
                                <a href="index.php?sec=producto&id=<?= $dadatina->getId() ?>" class="btn btn-violeta w-100 fw-bold text-blanco">VER MÁS</a>  
                            </div>

                        </div>
                    </div>
                <?PHP } ?>
                
              
            </div>
            <?php }else{ ?>
                <div class="row img-fluid">
                    <img src="./img/error/error_404_2.png" alt="chico enojado mirando la computadora" class="d-block mx-auto mb-5">
                <div class="col-12 text-danger text-center h2"><h2>No se encontró el producto </h2>  </div>
                </div> 
           <?php } ?>
        </div>

    </div>
</div>