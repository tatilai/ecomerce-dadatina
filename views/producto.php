

<?php


/*
if($productoSeleccionado){
    $producto = $catalogo[$productoSeleccionado];
}*/

$id = $_GET['id'] ?? FALSE;

/*$miObjetoDadatina = new Dadatina();

$dadatina =$miObjetoDadatina->producto_x_identificacion($id);*/

$dadatina = (new Dadatina())->producto_x_identificacion($id); 


/*$productoSeleccionado = $_GET['prod'] ?? FALSE;*/

?>



<div class=" d-flex justify-content-center p-5 bg-rosita">
    <div>       

        <div class="container">

           
            <div class="row">             
              <?php if(!empty($dadatina)){ ?>
                
                <h1 class="text-center my-5"> <?= $dadatina->getTitulo(); ?></h1>
                    <div class="col">
                        <div  class="card border border-verde mb-5">
                            <div class="row g-0"> 
                                <div class="col-md-5">
                                    <img src="img/cremas/<?= $dadatina->getImagen() ?>" class="card-img-top" alt="Portada de <?= $dadatina->nombre_completo() ?>"> 
                                </div>                           
                      
                           <div class="col-12 col-md-6 col-lg-3">
                            <div class="card-body flex-grow-0">
                                <p class="fs-6 m-0 fw-bold text-lila"><?= $dadatina->nombre_completo() ?></p>
                                <h2 class="card-title "><?= $dadatina->getTitulo() ?></h2>
                                <p class="card-text"><?=$dadatina->getModoDeuso()?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><span class="fw-bold text-lila">Protección solar:</span> <?= $dadatina->getProteccionSolar() ?></li>
                                <li class="list-group-item"><span class="fw-bold text-lila">Producto hipoalergénico:</span> <?= $dadatina->getProductoHipoalergenico() ?></li>
                                <li class="list-group-item"><span class="fw-bold text-lila">Momento de aplicación:</span> <?= $dadatina->getMomentoDeAplicacion() ?></li>
                                <li class="list-group-item"><span class="fw-bold text-lila">Fecha de vencimiento:</span> <?= $dadatina->getFechaDeVencimiento() ?></li>

                                <li class="list-group-item">
                                    <h3 class="mb-3 fw-bold text-lavanda">Ingredientes del producto</h3>
                                    <?PHP foreach ($dadatina->getIngredientes_ids() as $value) { ?>
                                        <div class="row pb-3 mb-3 border-bottom">
                                            <div class="col-9">
                                           
                                                <p class="text-dark"><?= $value->getIngredientes(); ?></p>
                                            </div>
                                          

                                        </div>
                                    <?PHP  } ?>

                                </li>

                            </ul>
                            <div class="card-body flex-grow-0 mt-auto">
                                <div class="fs-3 mb-3 fw-bold text-center text-lavanda">$<?=$dadatina->precio_nuevo()?></div>



                                <form action="admin/actions/add_item_acc.php" method="GET" class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <label for="q" class="fw-bold me-2">Cantidad: </label>
                                        <input type="number" class="form-control" value="1" name="q" id="q">
                                    </div>
                                    <div class="col-6">
                                        <input type="submit" value="AGREGAR A CARRITO" class="btn btn-crema fw-bold">
                                        <input type="hidden" value="<?= $id ?>" name="id" id="id">

                                    </div>
                                </form>

                                 
                            </div>
                        </div>
                           
                    </div>

                        </div>
                    </div>
              
                
              
            </div>
            <?php }else{ ?>
                <div class="row img-fluid">
                <img src="./img/error/error_404_2.png" alt="chico enojado mirando la computadora" class="d-block mx-auto mb-5">
                <div class="col-12 text-danger text-center h2"><h2> No se encontró el producto</h2> </div>
                </div> 
           <?php } ?>
        </div>

    </div>
</div>