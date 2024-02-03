<?php



$catalogo = (new Dadatina())->catalogo_completo();
// echo"<pre>";
// print_r($catalogo);
// echo "</pre>";

/*require_once "libraries/productos.php";*/
/*
if($productoSeleccionado){
    $producto = $catalogo[$productoSeleccionado];
}*/

/*$productoSeleccionado = $_GET['prod'] ?? FALSE;

$miObjetoDadatina = new Dadatina();

$catalogoDeProductos =$miObjetoDadatina->catalogo_completo();*/

?>



 
<div class=" d-flex justify-content-center p-5 bg-crema">
    <div>
        <h1 class="text-center mb-5 fw-bold">Todos los productos</h1>

        <div class="container">

            <?php if(!empty($catalogo)){ ?>
            <div class="row">           
             
            

                
                   

                   <?php foreach ($catalogo as $dadatina){?>
                     <div class="col-12 col-md-6 col-lg-3">
                        <div  class="card border border-super mb-3">
                        <img  src="img/cremas/<?= $dadatina->getImagen() ?>" class="card-img-top " alt="Portada de <?= $dadatina->nombre_completo()?>">
                           
                            <div  class="card-body" style="height:15rem">
                                <p class="fs-6 m-0 fw-bold text-lila"><?= $dadatina->nombre_completo()?></p>
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
                 <?php } ?>
                   
                
              
            </div>
            <?php }else{ ?>
                <div class="row img-fluid">
                    <img src="./img/error/error_404_2.png" alt="chico enojado mirando la computadora" class="d-block mx-auto img-fluid">
                <div class="col-12 text-danger text-center h2"> <h2>No se encontró el producto </h2> </div>
                </div> 
           <?php } ?>
        </div>

    </div>
</div>