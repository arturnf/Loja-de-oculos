<?php

namespace App\Http\Controllers;

use App\Models\Colecao;
use App\Models\Produto;
use App\Models\TipoProduto;
use App\Models\NumeroCelular;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        
        $categorias = TipoProduto::all();
        $colecao = Colecao::orderBy('id', 'desc')->first();
        return view('home', ['colecao' => $colecao, 'categorias' => $categorias]);
    }
    
    public function loja(){
        $pagProduto = false;
        $produtos = Produto::orderBy('id', 'desc')->get();
        $tipos = TipoProduto::all();
        return view('loja', ['tipos' => $tipos, 'produtos' => $produtos, 'pagProduto' => $pagProduto]);
    }

    public function lojaCategoria($id){
        $produtos = Produto::where('tipoproduto_id', $id)->orderBy('id', 'desc')->get();
        $categoria = TipoProduto::find($id);
        $tipos = TipoProduto::all();
        $pagProduto = true;

        return view('loja', ['tipos' => $tipos, 'produtos' => $produtos, 'pagProduto' => $pagProduto, 'categoria' => $categoria]);
    }


    public function colecoes(){
       
        $colecoes = Colecao::orderBy('id', 'desc')->get();

        return view('colecoes', ['colecoes' => $colecoes]);
    }


    public function colecaoShow($id){
        $produtos = Produto::where('colecao_id', $id)->orderBy('id', 'desc')->get();
        $colecao = Colecao::find($id);

        return view('colecao', ['colecao' => $colecao, 'produtos' => $produtos]);

    }

    public function contato(){
        
        return view('contatos');
    }

    public function sobre(){
    
        return view('sobre');
    }



    public function contatoWhatsapp(){
        $numero = NumeroCelular::find(1);
        $numeroWhatsApp = $numero->numero; 
        $urlWhatsApp = "https://wa.me/$numeroWhatsApp";

        
        return redirect($urlWhatsApp);
    }



    public function pagProduto($id){
        $produto = Produto::find($id);

        return view('produtoPagina', ['produto' => $produto]);
    }
}
