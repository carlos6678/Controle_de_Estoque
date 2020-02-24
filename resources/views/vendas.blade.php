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
                <a class="list-group-item mt-1 item-painel-norm active" href="vendas">
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
        <div class="col-10 corpo">
            <div class="total_vendas mb-1">
                <div class="circle">
                    <h2>Valor total</h2>
                    <h3>R$ {{$total_vendas}}</h3>
                </div>
            </div>
            <form action="" method="post" class="form-inline pesquisa_venda mt-3 mb-3">
                <input type="text" placeholder="Pesquisar Venda" class="form-control-lg">
                <input type="submit" value="Pesquisar" class="btn btn-lg btn-dark">
            </form>
            <table class="table table-striped">
                <thead>
                    <th>Cep</th>
                    <th>Razao</th>
                    <th>Produto</th>
                    <th>Compra</th>
                    <th>Data</th>
                <tbody>
                    @foreach($vendas as $venda)
                        <tr hidden>
                            @foreach($venda as $key=>$venda1)
                                @if($key==3)
                                    <td>R$ {{$venda1}}</td>
                                @else
                                    <td>{{$venda1}}</td>
                                @endif
                            @endforeach
                        </tr>
                     @endforeach
                </tbody>
            </table>
            <div class="buttons_v">
                <button class="btn btn-outline-primary btn-lg" id="ver_mais">Ver mais</button>
                <button class="btn btn-outline-primary btn-lg" id="ver_menos">Ver menos</button>
            </div>
        </div>
    </div>
</div>
@endsection
