@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-2 menu_lateral" style="background-color: #363636;">
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
                    <a class="list-group-item mt-1 item-painel-norm" href="addCliente">
                        <ion-icon name="add-outline"></ion-icon>
                        Adcionar Clientes
                    </a>
                    <a class="list-group-item mt-1 item-painel-norm" href="addUsuario">
                        <ion-icon name="add-outline"></ion-icon>
                        Adcionar Usuarios
                    </a>
                    <a class="list-group-item mt-1 item-painel-norm active" href="addFabricante">
                        <ion-icon name="add-outline"></ion-icon>
                        Adcionar Fabricante
                    </a>
                </div>

            </ul>
        </div>
        <div class="col-10">
            <h1>Cadastrar fabricante</h1>

            <form action="addFabricante" method="post" class="form-row">
                {{ csrf_field() }}
                <div class="col-6 mb-3">
                    <input type="text" class="form-control w-100" name="nome" placeholder="Nome">
                </div>
                <div class="col-6"> 
                    <input type="email" class="form-control w-100" name="email" placeholder="E-mail">
                </div>
                <div class="col-5 mb-3">
                    <input type="text" class="form-control w-100" name="cnpj" placeholder="CNPJ/CPF">
                </div>
                <div class="col-3">
                    <input type="text" class="form-control w-100" name="uf" placeholder="Estado">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control w-100" name="municipio" placeholder="Municipio">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control w-100" name="tel" placeholder="Telefone">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control w-100" name="bairro" placeholder="Bairro">
                </div>
                <div class="col-2">
                    <input type="text" class="form-control w-100" name="rua" placeholder="Rua">
                </div>
                <div class="col-2">
                    <input type="text" class="form-control w-100" name="numero" placeholder="Numero">
                </div>

                <input type="submit" class="btn btn-darkleve mt-3" value="Cadastrar">
            </form>

        </div>
    </div>
</div>
@endsection