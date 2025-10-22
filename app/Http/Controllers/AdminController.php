<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Colecao;
use App\Models\Produto;
use App\Models\TipoProduto;
use App\Models\NumeroCelular;

class AdminController extends Controller
{


    public function login(){
        if(Auth::check()){
            return redirect()->route('admin');
        }

        return view('adm.login');
    }

    public function auth(Request $request){
        $crendenciais = $request->validate([
            'name'=>['required'],
            'password'=>['required']
        ],[
            'name.required' => 'O campo nome precisa ser preenchido',
            'password.required' => 'O campo senha precisa ser preenchido'
        ]);

        if(Auth::attempt($crendenciais)){
            $request->session()->regenerate();
            return redirect()->route('admin');
        }else{
            return redirect()->back()->withErrors('Usuário inexistente');
        }
    }

    public function logout(Request $request){
        Auth::logout(); // Faz logout do usuário

        $request->session()->invalidate(); // Invalida toda a sessão
        $request->session()->regenerateToken(); // Regenera o token CSRF

        return redirect()->route('login.adm'); // Redireciona para a página de login
    }






     public function painel(){
        if (!Auth::check()) {
            return redirect()->route('login.adm');
        }
        $produtos = Produto::orderBy('id', 'desc')->get();
        $total = Produto::sum('preco');
        return view('adm.produto.produtoPainel', ['produtos' => $produtos, 'total' => $total]);
    }



    public function painelTipos(){
        if(Auth::check()){
            $tipos = TipoProduto::all();
            $totalTipos = TipoProduto::count();
            $totalProdutosTipados = Produto::whereNotNull('tipoproduto_id')->count();

            return view('adm.categoria.categoriaPainel', ['categoria' => $tipos, 'totalCategoria' => $totalTipos, 'totalProdutosCat' => $totalProdutosTipados]);
        }

        return redirect()->route('login.adm');
    }




    public function painelColecao(){
        if(Auth::check()){
            $colecoes = Colecao::all();
            $totalColecoes = Colecao::count();
            $totalProdutosColecoes = Produto::whereNotNull('colecao_id')->count();

            return view('adm.colecao.colecaoPainel', ['colecoes' => $colecoes, 'totalColecoes' => $totalColecoes, 'totalProdutosColecoes' => $totalProdutosColecoes]);
        }

        return redirect()->route('login.adm');
    }




    public function settings(){
        if(Auth::check()){
            $numero = NumeroCelular::find(1);

            return view('adm.whatsappLoja', ['numero'=>$numero]);
        }
        return redirect()->route('login.adm');

    }

    public function editandoNumero(Request $request, $id){
        if(Auth::check()){
            $request->validate([
                'numero' => 'required',
            ]);

            $numero = NumeroCelular::find($id);

            $numero->update([
                'numero' => $request->input('numero')
            ]);
            return redirect()->route('admin.config')->with('success', 'numero atualizado com sucesso');
        }
        return redirect()->route('login.adm');
    }
}
