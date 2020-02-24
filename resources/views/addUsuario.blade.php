@extends('layouts.app')

@section('content')
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

                <button class="list-group-item mt-1 item-painel active" data-toggle="collapse" href="#pessoas" role="button" aria-expanded="false" aria-controls="pessoas">
                    Cadastro
                    <ion-icon name="arrow-down-outline" style="font-size:20px"></ion-icon>
                </button>
                <div class="collapse" id="pessoas" href="">
                    <a class="list-group-item mt-1 item-painel-norm" href="addCliente">
                        <ion-icon name="add-outline"></ion-icon>
                        Adcionar Clientes
                    </a>
                    <a class="list-group-item mt-1 item-painel-norm active" href="addUsuario">
                        <ion-icon name="add-outline"></ion-icon>
                        Adcionar Usuarios
                    </a>
                </div>

                <button class="list-group-item mt-1 item-painel" data-toggle="collapse" href="#configurar" role="button" aria-expanded="false" aria-controls="configurar">
                    Configurções
                    <ion-icon name="arrow-down-outline" style="font-size:20px"></ion-icon>
                </button>
                <div class="collapse" id="configurar">
                    <a class="list-group-item mt-1 item-painel-norm" href="">
                        <ion-icon name="create-outline" style="font-size:20px"></ion-icon>
                        Editar conta
                    </a>
                </div>

                <button class="list-group-item mt-1 item-painel" data-toggle="collapse" href="#relatorios" role="button" aria-expanded="false" aria-controls="relatorios">
                    Relatorios
                    <ion-icon name="arrow-down-outline" style="font-size:20px"></ion-icon>
                </button>
                <div class="collapse" id="relatorios" href="">
                    <a class="list-group-item mt-1 item-painel-norm" href="relatorio_v">
                        <ion-icon name="stop-circle-outline" style="font-size:20px"></ion-icon>
                        Relatorio de vendas
                    </a>
                    <a class="list-group-item mt-1 item-painel-norm" href="relatorio_m">
                        <ion-icon name="stop-circle-outline" style="font-size:20px"></ion-icon>
                        Relatorio Mensal
                    </a>
                    <a class="list-group-item mt-1 item-painel-norm" href="relatorio_d">
                        <ion-icon name="stop-circle-outline" style="font-size:20px"></ion-icon>
                        Relatorio diario
                    </a>
                </div>
            </ul>
        </div>

        <div class="col-10">
            <h1>Usuarios</h1>

            <table class="table table-striped">
                <thead>
                    <th>Nome</th>
                    <th>Email</th>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h1>Cadastrar usuario</h1>
            <form action="addUsuario" method="post" class="form-inline">
                {{ csrf_field() }}
                <input type="text" class="form-control mr-1" name="nome" required placeholder="Nome do usuario">
                <input type="email" class="form-control mr-1" name="email" required placeholder="E-mail">
                <input type="password" class="form-control mr-1" name="senha" required placeholder="Senha">
                <input type="submit" class="btn btn-success" value="Cadastrar">
            </form>
        </div>
    </div>
</div>
@endsection
