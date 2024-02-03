
<?php
$cremas = (new Carrito())->get_carrito();

/*echo "<pre>";
print_r($cremas);
echo "</pre>"; */

?>




<h1 class="text-center fs-2 my-5">Carrito de compras</h1>
<div class="container my-4">

<?PHP if (count($cremas)) { ?>
        <form action="admin/actions/update_items_acc.php" method="POST">

            <table class="table">

                <thead>
                    <tr>
                        <th scope="col" width="15%">Imagen</th>
                        <th scope="col">Datos del producto</th>
                        <th scope="col" width="15%">Cantidad</th>
                        <th class="text-end" scope=" col" width="15%">Precio Unitario</th>
                        <th class="text-end" scope="col" width="15%">Subtotal</th>
                        <th class="text-end" scope="col" width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?PHP foreach ($cremas as $key => $item) { ?>
                        <tr>
                            <td><img src="img/cremas/<?= $item['imagen'] ?>" alt="Imágen Illustrativa de <?= $item['titulo'] ?>" class="img-fluid rounded shadow-sm"></td>

                            <td class="align-middle">
                                <h2 class="h5"><?= $item['titulo'] ?></h2>
                                <p><?= $item['producto'] ?></p>
                            </td>
                            <td class="align-middle">
                                <label for="q_<?= $key ?>" class="visually-hidden">Cantidad</label>
                                <input type="number" class="form-control" value="<?= $item['cantidad'] ?>" id="q_<?= $key ?>" name="q[<?= $key ?>]">
                            </td>
                            <td class="text-end align-middle">
                                <p class="h5 py-3">$<?= number_format($item['precio'], 2, ",", ".") ?></p>
                            </td>
                            <td class="text-end align-middle">
                                <p class="h5 py-3"> $<?= number_format($item['cantidad'] * $item['precio'], 2, ",", ".") ?></p>
                            </td>
                            <td class="text-end align-middle">
                                <a href="admin/actions/remove_item_acc.php?id=<?= $key ?>" class="btn btn-sm btn-azul">Eliminar</a>
                            </td>
                        </tr>
                    <?PHP } ?>

                    <tr>
                        <td colspan="4" class="text-end">
                            <h2 class="h5 py-3">Total:</h2>
                        </td>
                        <td class="text-end">

                        <p class="h5 py-3">$<?= number_format((new Carrito())->precio_total(), 2, ",", ".") ?></p>
                        
                        </td>
                        <td></td>
                    </tr>
                </tbody>



            </table>



            <div class="d-flex justify-content-end gap-2">
                <input type="submit" value="Actualizar Cantidades" class="btn btn-warning">
                <a href="index.php?sec=catalogo" role="button" class=" btn btn-verde">Seguir comprando</a>
                <a href="admin/actions/clear_items_acc.php" role="button" class="btn btn-danger">Vaciar Carrito</a>
                <a href="index.php?sec=terminar_compra" role="button" class="btn btn-lila">Finalizar Compra</a>
            </div>

        </form>
    <?PHP } else { ?>
        <h2 class="text-center mb-5 text-lila">Su carrito esta vacio</h2>
    <?PHP } ?>






</div>