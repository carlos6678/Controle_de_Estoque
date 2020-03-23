<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;
use App\Compras;
use App\Vendas;
use App\Fabricantes;
use App\Clientes;
use Illuminate\Support\Facades\Auth;
use App\JsonOutput;
class AjaxController extends Controller
{   
    private function getSaida($array){
        JsonOutput::mostrar($array);
        //Padrao de projeto strategy usado mais por boas praticas
    }
    public function infoProduto($id){
        $produtos=Produtos::find($id);
        $fabricante= new Fabricantes;
        if($produtos->fabricantes_id==null){
            $produtos->fabricantes_id="Nenhum";
        }else{
            $fabricante_nome=$fabricante->find($produtos->fabricantes_id);
            $produtos->fabricantes_id=$fabricante_nome->nome;
        }

        $this->getSaida($produtos);
    }
    public function infoCliente($id){
        $this->getSaida(Clientes::find($id));
    }
    public function infoFabricante($id){
        $this->getSaida(Fabricantes::find($id));
    }
    public function addProduto(Request $req){
        $array=array(
            'status'=>0,
            'error'=>''
        );
        if($req->isMethod('post')){
            if($req->filled(['nome','representante','Venda','Compra','fabricacao','vencimento']) && $req->filled('fabricante')){
                $fabricante=Fabricantes::select('id')->where('nome',$req->input('fabricante'))->get();
                if(count($fabricante)>0){

                    $fabricacao=explode('/',$req->fabricacao);
                    $vencimento=explode('/',$req->vencimento);
                    $fabricacao=array_reverse($fabricacao);
                    $vencimento=array_reverse($vencimento);
                    $fabricacao=implode('-',$fabricacao);
                    $vencimento=implode('-',$vencimento);

                    $produto=new Produtos;
                    $produto->nome=$req->input('nome');
                    $produto->fabricantes_id=$fabricante[0]['id'];
                    $produto->representante=$req->input('representante');
                    $produto->valor_venda=$req->input('Venda');
                    $produto->valor_compra=$req->input('Compra');
                    $produto->data_fabricaçao=$fabricacao;
                    $produto->data_vencimento=$vencimento;

                    $produto->save();
                }else{
                    $array['status']=1;
                    $array['error']="Fabricante não cadastrado no sistema";
                }

            }
            elseif($req->filled(['nome','representante','Venda','Compra','fabricacao','vencimento']) && !$req->filled('fabricante')){
                $fabricacao=explode('/',$req->fabricacao);
                $vencimento=explode('/',$req->vencimento);
                $fabricacao=array_reverse($fabricacao);
                $vencimento=array_reverse($vencimento);
                $fabricacao=implode('-',$fabricacao);
                $vencimento=implode('-',$vencimento);

                $produto=new Produtos;
                $produto->nome=$req->input('nome');
                $produto->fabricantes_id=null;
                $produto->representante=$req->input('representante');
                $produto->valor_venda=$req->input('Venda');
                $produto->valor_compra=$req->input('Compra');
                $produto->data_fabricaçao=$fabricacao;
                $produto->data_vencimento=$vencimento;

                $produto->save();
            }else{
                $array['status']=1;
                $array['error']="Erro em algum dado nao enviado ou esta vazio";
            }
        }else{
            $array['status']=1;
            $array['error']="Metodo de requisição invalido";
        }
        $this->getSaida($array);
    }
    public function editarProduto($id,Request $req){
        $array=array(
            'status'=>0,
            'error'=>''
        );
        if($req->isMethod('post')){
            if($req->filled(['nome','fabricante','representante','Venda','Compra','fabricacao','vencimento'])){
                if($req->fabricante=="Nenhum"){
                    $produto=Produtos::find($id);
                    $produto->nome=$req->input('nome');
                    $produto->fabricantes_id=null;
                    $produto->representante=$req->input('representante');
                    $produto->valor_venda=$req->input('Venda');
                    $produto->valor_compra=$req->input('Compra');
                    $produto->data_fabricaçao=$req->fabricacao;
                    $produto->data_vencimento=$req->vencimento;

                    $produto->save();
                }
                if(count(Fabricantes::select('id')->where('nome',$req->input('fabricante'))->get())>0){
                    $produto=Produtos::find($id);
                    $produto->nome=$req->input('nome');
                    $produto->fabricantes_id=Fabricantes::select('id')->where('nome',$req->input('fabricante'))->get()[0]['id'];
                    $produto->representante=$req->input('representante');
                    $produto->valor_venda=$req->input('Venda');
                    $produto->valor_compra=$req->input('Compra');
                    $produto->data_fabricaçao=$req->fabricacao;
                    $produto->data_vencimento=$req->vencimento;

                    $produto->save();
                }
                else{
                    $array['status']=1;
                    $array['error']='Fabricante não cadastrado';
                }
                
            }else{
                $array['status']=1;
                $array['error']='Algum dado esta vazio';
            }
        }else{
            $array['status']=1;
            $array['error']='Metodo de requisição invalido';
        }
        $this->getSaida($array);
    }
    public function excluirProduto(Request $req){
        if($req->isMethod('delete')){
            if($req->has('id')){
                Produtos::find($req->input('id'))->delete();
                Compras::where('produto_id',$req->input('id'));
                Vendas::where('produtos_id',$req->input('id'));
            }
        }
    }
    public function addVendas(Request $req){
        $array=array(
            'status'=>0,
            'error'=>''
        );
        if($req->isMethod('post')){

            if($req->filled(['cliente','produto','qtproduto'])){
                if(Clientes::find($req->cliente)){
                    if(Produtos::find($req->produto)){
                        $produto_qt=Produtos::find($req->produto);
                        if($produto_qt->quantidade>=intval($req->input('qtproduto'))){
                            $venda=new Vendas;
                            $venda->clientes_id=intval($req->input('cliente'));
                            $venda->produtos_id=intval($req->input('produto'));
                            $venda->valor_venda=$produto_qt->valor_venda*intval($req->input('qtproduto'));
                            $venda->qtproduto=intval($req->input('qtproduto'));
                            $venda->data_venda=date('Y-m-d');
                            $venda->save();

                            $produto_qt->quantidade=$produto_qt->quantidade-intval($req->input('qtproduto'));
                            $produto_qt->save();
                        }else{
                            $array['status']=1;
                            $array['error']='Quantidade de compra maior que a quantidade em estoque';
                        }
                    }else{
                        $array['status']=1;
                        $array['error']='Produto não existe';
                    }
                }else{
                    $array['status']=1;
                    $array['error']='Cliente não existe';
                }
            }else{
                $array['status']=1;
                $array['error']='Não foram preenchidos todos os dados';
            }
        }else{
            $array['status']=1;
            $array['error']='Metodo de requisição invalido';
        }
        $this->getSaida($array);
    }
    public function addCompras(Request $req){
        $array=array(
            'status'=>0,
            'error'=>''
        );

        if($req->isMethod('post')){
            if($req->filled(['produto','qt','valor'])){
                $produto=Produtos::find(intval($req->input('produto')));
                if($produto){
                    $compra=new Compras;
                    $compra->comprador=Auth::user()->name;
                    $compra->produto_id=intval($req->input('produto'));
                    $compra->quantidade=intval($req->input('qt'));
                    $compra->valor=floatval($req->input('valor'));
                    $compra->data_compra=date('Y-m-d');
                    $compra->save();

                    $produto->quantidade=$produto->quantidade+intval($req->input('qt'));
                    $produto->save();
                }else{
                    $array['status']=1;
                    $array['error']='Produto não cadastrado no sistema';
                }
            }else{
                $array['status']=1;
                $array['error']='Alguns dados não enviados';
            }
        }else{
            $array['status']=1;
            $array['error']='Metodo de requisição invalido';
        }
        $this->getSaida($array);
    }
    public function salvarCliente($id,Request $req){
        $array=array(
            'status'=>0,
            'error'=>''
        );

        if($req->isMethod('post')){
            if($req->filled(['cep','razao','cnpj','uf','municipio','tel','bairro','rua','numero'])){
                $cliente=Clientes::find($id);
                $cliente->cep=$req->input('cep');
                $cliente->razao_social=$req->input('razao');
                $cliente->cnpj=$req->input('cnpj');
                $cliente->estado=$req->input('uf');
                $cliente->municipio=$req->input('municipio');
                $cliente->telefone=$req->input('tel');
                $cliente->bairro=$req->input('bairro');
                $cliente->rua=$req->input('rua');
                $cliente->numero=$req->input('numero');
                $cliente->save();
            }else{
                $array['status']=1;
                $array['error']='Alguns dados não enviados';
            }
        }else{
            $array['status']=1;
            $array['error']='Metodo de requisição invalido';
        }
        $this->getSaida($array);
    }
    public function excluirCliente($id,Request $req){
        if($req->isMethod('delete')){
            Clientes::where('id',$id)->delete();
        }
    }
    public function salvarFabricante($id,Request $req){
        $array=array(
            'status'=>0,
            'error'=>''
        );

        if($req->isMethod('post')){
            if($req->filled(['nome','email','cnpj','uf','municipio','tel','bairro','rua','numero'])){
                $fabricantes=Fabricantes::find($id);
                $fabricantes->nome=$req->input('nome');
                $fabricantes->email=$req->input('email');
                $fabricantes->cnpj=$req->input('cnpj');
                $fabricantes->estado=$req->input('uf');
                $fabricantes->municipio=$req->input('municipio');
                $fabricantes->telefone=$req->input('tel');
                $fabricantes->bairro=$req->input('bairro');
                $fabricantes->rua=$req->input('rua');
                $fabricantes->numero=$req->input('numero');
                $fabricantes->save();
            }else{
                $array['status']=1;
                $array['error']='Algum campo não preenchido';
            }
        }else{
            $array['status']=1;
            $array['error']="Metodo de requisição invalido";
        }
        $this->getSaida($array);
    }
    public function excluirFabricante($id,Request $req){
        if($req->isMethod('delete')){
            Fabricantes::where('id',$id)->delete();
        }
    }
}