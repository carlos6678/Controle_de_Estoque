<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Fabricantes;
use App\Vendas;
use App\Produtos;
use App\Clientes;
use App\Compras;
use App\User;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $dados=array();
        return view('home',$dados);
    }
    public function listarprodutos(){
        $dados=array(
            'produtos'=>array()
        );
        $produtcts[]=Produtos::paginate(2);
        foreach($produtcts as $p){
            foreach($p as $p1){
                if($p1['fabricantes_id']==null){
                    $p1->fabricantes_id="Nenhum";
                }else{
                    $fabricantes=Fabricantes::find($p1['fabricantes_id']);
                    if(!empty($fabricantes)){
                        $p1->fabricantes_id=$fabricantes['nome'];
                    }
                }
            }
        }
        $dados['produtos']=$produtcts;
        return view('listarprodutos',$dados);
    }
    public function vendas(){
        $dados=array(
            'vendas'=>array(),
            'total_vendas'=>0
        );
        $valor_vendas=Vendas::select('valor_venda')->get();
        $dados['total_vendas']=$valor_vendas->sum('valor_venda');

        $array=Vendas::all()->sortByDesc('data_venda');
        foreach($array as $key=>$value){
 
            $Produtos=Produtos::find($value['produtos_id']);
            $Clientes=Clientes::find($value['clientes_id']);

            $venda=array($Clientes->cep,$Clientes->razao_social,$Produtos->nome,$value['valor_venda'],$value['qtproduto'],$value['data_venda']);

            $dados['vendas'][$key]=$venda;
        }
        return view('vendas',$dados);
    }
    public function compras(){
        $dados=array(
            'compras'=>array()
        );
        $compras=Compras::paginate(10);

        foreach($compras as $key=>$compra){
            $Produto=Produtos::find($compra['produto_id']);
            $compras[$key]->produto_id=$Produto->nome;
        }
        $dados['compras']=$compras;
        return view('compras',$dados);
    }
    public function clientes(){
        $dados=array(
            'clientes'
        );
        $dados['clientes']=Clientes::paginate(10);
        return view('clientes',$dados);
    }
    public function adicionarClientes(Request $req){

        if($req->has('cep')){
            $clinte=$req->all();
            $clientes=new Clientes;

            $clientes->cep=$clinte['cep'];
            $clientes->razao_social=$clinte['razao'];
            $clientes->cnpj=$clinte['cnpj'];
            $clientes->estado=$clinte['UF'];
            $clientes->municipio=$clinte['municipio'];
            $clientes->telefone=$clinte['tel'];
            $clientes->bairro=$clinte['bairro'];
            $clientes->rua=$clinte['rua'];
            $clientes->numero=$clinte['numero'];

            $clientes->save();

            return redirect('clientes');
        }
        return view('addCliente');
    }
    public function adicionarUsuarios(Request $req){
        $dados=array(
            'users'=>array()
        );

        if($req->has('nome')){
            $user=new User;
            $user->name=$req->input('nome');
            $user->email=$req->input('email');
            $user->password=Hash::make($req->input('senha'));
            $user->save();
        }
        $dados['users']=User::paginate(5);
        return view('addUsuario',$dados);
    }
    public function relatorio_vendas(){
        //pendente
    }
    public function relatorio_mensal(){
        //pendente
    }
    public function relatorio_diario(){
        //pendente
    }
}