<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-2" style="background-color: #363636;">
            <div class="dashboard">
                <ion-icon name="tv-outline" style="font-size:40px"></ion-icon>
                <h3>Painel</h3>
            </div>
            <ul class="list-group">
                <a class="list-group-item mt-1 item-painel-norm" href="produtos">
                    <ion-icon name="pricetags-outline" style="font-size:30px"></ion-icon>
                    Produtos
                </a>
                <a class="list-group-item mt-1 item-painel-norm" href="vendas">
                    <ion-icon name="cash-outline" style="font-size:30px"></ion-icon>
                    Vendas
                </a>
                <a class="list-group-item mt-1 item-painel-norm active" href="compras">
                    <ion-icon name="cart-outline" style="font-size:30px"></ion-icon>
                    Compras
                </a>
                <a class="list-group-item mt-1 item-painel-norm" href="clientes">
                    <ion-icon name="people-outline" style="font-size:30px"></ion-icon>
                    Clientes
                </a>
                <a class="list-group-item mt-1 item-painel-norm" href="fabricantes">
                    <ion-icon name="people-outline" style="font-size:30px"></ion-icon>
                    Fabricantes
                </a>

                <button class="list-group-item mt-1 item-painel" data-toggle="collapse" href="#pessoas" role="button" aria-expanded="false" aria-controls="pessoas">
                    Cadastro
                    <ion-icon name="arrow-down-outline" style="font-size:20px"></ion-icon>
                </button>
                <div class="collapse" id="pessoas" href="">
                    <a class="list-group-item mt-1 item-painel-norm" href="addCliente">
                        <ion-icon name="add-outline"></ion-icon>
                        Adcionar Clientes
                    </a>
                    <a class="list-group-item mt-1 item-painel-norm" href="addUsuario">
                        <ion-icon name="add-outline"></ion-icon>
                        Adcionar Usuarios
                    </a>
                    <a class="list-group-item mt-1 item-painel-norm" href="addFabricante">
                        <ion-icon name="add-outline"></ion-icon>
                        Adcionar Fabricante
                    </a>
                </div>

            </ul>
        </div>

        <div class="col-10">

            <div class="filtros mb-3">
                <div><?php echo e($compras->links()); ?></div>
                <h1>Compras feitas</h1>
                <form action="" class="form-inline">
                    <input type="text" class="form-control form-control-lg" placeholder="Pesquisar compras">
                    <input type="submit" class="btn btn-dark btn-lg" value="Pesquisar">
                </form>
            </div>

            <table class="table table-striped table-tableleve">
                <thead>
                    <th>Comprador</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Data</th>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $compras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $compra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($compra->comprador); ?></td>
                            <td><?php echo e($compra->produto_id); ?></td>
                            <td><?php echo e($compra->quantidade); ?></td>
                            <td><?php echo e($compra->valor); ?></td>
                            <td><?php echo e($compra->data_compra); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <button class="btn btn-success" type="button" data-target="#addCompra" data-toggle="modal">Nova compra</button>

            <div class="modal fade" aria-labelladby="addCompraLabel" id="addCompra" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="addCompraLabel">Adicionar Compra</h1>
                            <button class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-row" id="formCompra">
                                <div class="col-4">
                                    <input type="text" class="form-control" placeholder="cod.Produto" name="produto">
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" placeholder="Quantidade" name="qt">
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" placeholder="Valor compra" name="valor">
                                </div>
                                <input type="submit" style="display:none" id="clickCompra">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-lg" data-dismiss="modal" onclick="addCompra()">Salvar</button>
                            <button class="btn btn-danger btn-lg" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Estoque\resources\views/compras.blade.php ENDPATH**/ ?>