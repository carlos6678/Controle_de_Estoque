<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;
use App\Compras;
use App\Vendas;
use App\Fabricantes;
class AjaxController extends Controller
{   
    public function infoProduto($id){
        $produtos=Produtos::find($id);
        $fabricante= new Fabricantes;
        if($produtos->fabricantes_id==null){
            $produtos->fabricantes_id="Nenhum";
        }else{
            $fabricante_nome=$fabricante->find($produtos->fabricantes_id);
            $produtos->fabricantes_id=$fabricante_nome->nome;
        }

        return $produtos;
    }
    public function addProduto(Request $req){
        $array=array(
            'status'=>0,
            'error'=>''
        );
        if($req->isMethod('post')){
            if($req->has(['nome','representante','Venda','Compra','fabricacao','vencimento']) && $req->filled('fabricante')){
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
            elseif($req->has(['nome','representante','Venda','Compra','fabricacao','vencimento']) && !$req->filled('fabricante')){
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
        return $array;
    }
    public function editarProduto($id,Request $req){
        $array=array(
            'status'=>0,
            'error'=>''
        );
        if($req->isMethod('post')){
            if($req->has(['nome','fabricante','representante','Venda','Compra','fabricacao','vencimento'])){
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
        return $array;
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
}
