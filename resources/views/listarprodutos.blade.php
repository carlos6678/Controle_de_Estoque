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
                <a class="list-group-item mt-1 item-painel-norm active" href="produtos">
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
            <div class="filtros mb-3">
                <div>{{$produtos[0]->links()}}</div>
                <h1>Produtos Cadastrados</h1>
                <form action="" method="post"class="form-inline">
                    <input type="text" class="form-control form-control-lg" placeholder="Pesquisar Produto">
                    <input type="submit" value="Pesquisar" class="btn btn-dark btn-lg">
                </form>
            </div>

            <table class="table table-striped">
                <thead>
                    <th>cod</th>
                    <th>Nome</th>
                    <th>Fabricante</th>
                    <th>Representante</th>
                    <th>Quantidade</th>
                    <th>Venda</th>
                    <th>Compra</th>
                    <th>Fabricação</th>
                    <th>Vencimento</th>
                    <th>Ações</th>
                </thead>

                <tbody>
                @foreach($produtos as $p)
                    @foreach($p as $key=>$p1)
                        <tr>
                            <td>{{$p1->id}}</td>
                            <td>{{$p1->nome}}</td>
                            <td>{{$p1->fabricantes_id}}</td>
                            <td>{{$p1->representante}}</td>
                            <td>{{$p1->quantidade}}</td>
                            <td>R${{$p1->valor_venda}}</td>
                            <td>R${{$p1->valor_compra}}</td>
                            <td>{{$p1->data_fabricaçao}}</td>
                            <td>{{$p1->data_vencimento}}</td>
                            <td>
                                <button class="btn btn-warning" onclick="editarProduto(this)" data-id="{{$p1->id}}">Editar</button>
                                <button class="btn btn-danger"  onclick="excluirProduto(this)" data-id="{{$p1->id}}">Excluir</button>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addproduto">Novo Produto</button>

            <div class="modal fade" id="addproduto" data-backdrop="static" role="dialog" aria-labelledby="title" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="title">Adicionar novo Produto</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="enviarProduto" class="form-group">
                                {{ csrf_field() }}
                                <input type="text" name="nome" placeholder="Nome" class="form-control-lg w-100 mb-2">
                            
                                <input  type="text" name="fabricante" placeholder="Fabricante" class="form-control-lg w-100 mb-2">
                            
                                <input type="text" name="representante" placeholder="Representante" class="form-control-lg w-100 mb-2">
                            
                                <input type="text" name="Venda" placeholder="Valor Venda" class="form-control-lg mb-2 w-100">
                            
                                <input type="text" name="Compra" placeholder="Valor Compra" class="form-control-lg w-100 mb-2">
                    
                                <input type="text" name="fabricacao" placeholder="Data Fabricação" class="form-control-lg w-100 mb-2">
                            
                                <input type="text" name="vencimento" placeholder="Data Vencimento" class="form-control-lg w-100">
                                
                                <input type="submit" id="click" style="display:none">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-lg" data-dismiss="modal" onclick="adicionarProduto()">Adicionar</button>
                            <button class="btn btn-danger btn-lg" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editProduto" data-backdrop="static" role="dialog" aria-labelledby="title1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="title1">Adicionar novo Produto</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editarProduto" class="form-group">
                                {{ csrf_field() }}
                                <input type="text" name="nome" placeholder="Nome" class="form-control-lg w-100 mb-2" >
                            
                                <input type="text" name="fabricante" placeholder="Fabricante" class="form-control-lg w-100 mb-2">
                            
                                <input type="text" name="representante" placeholder="Representante" class="form-control-lg w-100 mb-2">
                            
                                <input type="text" name="Venda" placeholder="Valor Venda" class="form-control-lg mb-2 w-100">
                            
                                <input type="text" name="Compra" placeholder="Valor Compra" class="form-control-lg w-100 mb-2">
                    
                                <input type="text" name="fabricacao" placeholder="Data Fabricação" class="form-control-lg w-100 mb-2">
                            
                                <input type="text" name="vencimento" placeholder="Data Vencimento" class="form-control-lg w-100">
                                
                                <input type="submit" id="click2" style="display:none">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-lg" data-dismiss="modal" onclick="salvarProduto()">Salvar Alterações</button>
                            <button class="btn btn-danger btn-lg" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="excluirProduto" data-backdrop="static" role="dialog" aria-labelledby="title2" aria-hidden="true">
            {{ csrf_field() }}
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="title2">Excluir Produto</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 style="color:white">Você quer mesmo excluir esse produto?</h4>
                            <p style="color:white">Se o produto for excluido todas suas informações serao apagadas permanentemente</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger btn-lg" data-dismiss="modal" onclick="excluirProdutoReal()">Excluir</button>
                            <button class="btn btn-danger btn-lg" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
