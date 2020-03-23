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
                <a class="list-group-item mt-1 item-painel-norm" href="compras">
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

                <button class="list-group-item mt-1 item-painel active" data-toggle="collapse" href="#pessoas" role="button" aria-expanded="false" aria-controls="pessoas">
                    Cadastro
                    <ion-icon name="arrow-down-outline" style="font-size:20px"></ion-icon>
                </button>
                <div class="collapse" id="pessoas" href="">
                    <a class="list-group-item mt-1 item-painel-norm active" href="addCliente">
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
            <h1>Cadastrar Cliente</h1>

            <form action="addCliente" method="post" class="form-row">
                <?php echo e(csrf_field()); ?>

                <div class="col-6 mb-3">
                    <input type="text" placeholder="Cep" class="form-control" name="cep" required>
                </div>

                <div class="col-6">
                    <input type="text" placeholder="razao social" class="form-control" name="razao" required>
                </div>

                <div class="col-6 mb-3">
                    <input type="text" class="form-control" placeholder="cnpj/cpf" name="cnpj" required>
                </div>

                <div class="col-2">
                    <select class="form-control" name="UF"required>
                        <option value="">UF</option>
                        <option value="MG">MG</option>
                    </select>
                </div>

                <div class="col-2">
                    <input type="text" class="form-control" placeholder="Municipio" name="municipio" required>
                </div>

                <div class="col-2">
                    <input type="text" class="form-control" placeholder="Telefone" name="tel" required>
                </div>

                <div class="col-4">
                    <input type="text" class="form-control" placeholder="Bairro" name="bairro" required>
                </div>

                <div class="col-4">
                    <input type="text" class="form-control" placeholder="Rua" name="rua" required>
                </div>

                <div class="col-4">
                    <input type="text" class="form-control" placeholder="Numero" name="numero" required>
                </div>
                <input type="submit" class="btn btn-darkleve mt-3" value="Cadastrar">
            </form> 
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Estoque\resources\views/addCliente.blade.php ENDPATH**/ ?>