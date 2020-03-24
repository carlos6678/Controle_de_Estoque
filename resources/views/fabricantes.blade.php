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
                <a class="list-group-item mt-1 item-painel-norm active" href="fabricantes">
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
                <div>{{$fabricantes->links()}}</div>
                <h1>Fabricantes Cadastrados</h1>
                <form action="" method="post" class="form-inline">
                    <input type="text" placeholder="Pesquisar Fabricante" class="form-control-lg">
                    <input type="submit" class="btn btn-dark btn-lg" value="Pesquisar">
                </form>
            </div>
            <table class="table table-striped table-tableleve">
                <thead>
                    <th>Cod</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>CNPJ</th>
                    <th>UF</th>
                    <th>Municipio</th>
                    <th>Telefone</th>
                    <th>Bairro</th>
                    <th>Rua</th>
                    <th>Numero</th>
                    <th>Ações</th>
                </thead>
                    @foreach($fabricantes as $fabricante)
                        <tr>
                            <td>{{$fabricante->id}}</td>
                            <td>{{$fabricante->nome}}</td>
                            <td>{{$fabricante->email}}</td>
                            <td>{{$fabricante->cnpj}}</td>
                            <td>{{$fabricante->estado}}</td>
                            <td>{{$fabricante->municipio}}</td>
                            <td>{{$fabricante->telefone}}</td>
                            <td>{{$fabricante->bairro}}</td>
                            <td>{{$fabricante->rua}}</td>
                            <td>{{$fabricante->numero}}</td>
                            <td>
                                <button class="btn btn-darkleve" data-id="{{$fabricante->id}}" onclick="editarFabricante(this)">Editar</button>
                                <button class="btn btn-danger" data-id="{{$fabricante->id}}" onclick="excluirFabricante(this)">Excluir</button>
                            </td>
                        </tr>
                    @endforeach
                <tbody>
                </tbody>
            </table>

            <div class="modal fade" id="editarFabricante" role="dialog" aria-labelladby="editarFabricanteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="editarFabricanteLabel">Editar Fabricante</h1>
                            <button class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-row" id="salvarFabricante">
                                <label class="col-form-label">Nome</label>

                                <div class="col-5 mb-3">
                                    <input type="text" class="form-control" name="nome">
                                </div>

                                <label class="col-form-label">E-mail</label>

                                <div class="col-3">
                                    <input type="text" class="form-control" name='email'>
                                </div>

                                <label class="col-form-label">CNPJ</label>

                                <div class="col-5 mb-3">
                                    <input type="text" class="form-control" name="cnpj">
                                </div>

                                <label class="col-form-label">UF</label>

                                <div class="col-4">
                                    <input type="text" class="form-control" name="uf">
                                </div>

                                <label class="col-form-label">Municipio</label>

                                <div class="col-4 mb-3">
                                    <input type="text" class="form-control" name="municipio">
                                </div>

                                <label class="col-form-label">Telefone</label>

                                <div class="col-3">
                                    <input type="text" class="form-control" name="tel">
                                </div>

                                <label class="col-form-label">Bairro</label>

                                <div class="col">
                                    <input type="text" class="form-control" name="bairro">
                                </div>

                                <label class="col-form-label">Rua</label>

                                <div class="col">
                                    <input type="text" class="form-control" name="rua">
                                </div>

                                <label class="col-form-label">Numero</label>

                                <div class="col">
                                    <input type="text" class="form-control" name="numero">
                                </div>

                                <input type="submit" id="enviarFabricante" style="display:none">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-lg btn-primary" data-dismiss="modal" onclick="salvarFabricante()">Salvar</button>
                            <button class="btn btn-lg btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="excluirFabricante" role="dialog" aria-labelladby="excluirFabricanteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="excluirFabricanteLabel">Excluir Fabricante</h1>
                            <button class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h1>VOCÊ TEM CERTEZA QUE QUER EXLCUIR?</h1>
                            <h6>
                                Se Você excluir o fabricante Você perderá os dados dele
                            </h6>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-lg btn-primary" data-dismiss="modal" onclick="excluirFabricanteTrue()">Excluir</button>
                            <button class="btn btn-lg btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
