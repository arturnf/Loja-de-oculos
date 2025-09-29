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
        $colecao = Colecao::orderBy('id', 'desc')->get();
        return view('homeAtualizada', ['colecao' => $colecao]);
    }
    
    public function loja($id){
        $produtos = Produto::where('tipoproduto_id', $id)->orderBy('id', 'desc')->paginate(1);
        $tipos = TipoProduto::all();
        $tipoOne = TipoProduto::find($id);
        return view('loja', ['tipos' => $tipos, 'produtos' => $produtos, 'tipoOne' => $tipoOne]);
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
