<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Colecao;
use App\Models\Produto;
use App\Models\TipoProduto;
use App\Models\NumeroCelular;
use App\Models\Banner;

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

    public function editarBanner(){
        if(Auth::check()){
            $banner = Banner::first();

            if (!$banner) {
                $banner = Banner::create([
                    'ativo' => true,
                ]);
            }

            return view('adm.banner.bannerEditar', ['banner' => $banner]);
        }
        return redirect()->route('login.adm');
    }


    //obs: ainda falta a parte de quando editar apagar as imagens que ja existem, 
    //e falta tbm criar um banner vazio no automatico com seeder para n dar erro
    public function processBanner(Request $request, $id){
        if(Auth::check()){
            $request->validate([
                'titulo' => 'nullable|string|max:255',
                'texto' => 'nullable|string',
                'texto_botao' => 'nullable|string|max:255',
                'link' => 'nullable|string|max:255',
                'ativo' => 'nullable|boolean',
                'img_desktop' => 'nullable|image|mimes:jpeg,png,jpg,webp',
                'img_mobile' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            ]);

            $banner = Banner::findOrFail($id);
            $data = $request->only(['titulo', 'texto', 'texto_botao', 'link']);
            $data['ativo'] = $request->has('ativo');

            if ($request->hasFile('img_desktop')) {
                // remove imagem desktop anterior se existir
                if ($banner->img_desktop && \Illuminate\Support\Facades\File::exists(public_path($banner->img_desktop))) {
                    \Illuminate\Support\Facades\File::delete(public_path($banner->img_desktop));
                }

                $desktopFile = $request->file('img_desktop');
                $desktopName = time() . '_desktop.' . $desktopFile->getClientOriginalExtension();
                $desktopFile->move(public_path('img/banners'), $desktopName);
                $data['img_desktop'] = 'img/banners/' . $desktopName;
            }

            if ($request->hasFile('img_mobile')) {
                // remove imagem mobile anterior se existir
                if ($banner->img_mobile && \Illuminate\Support\Facades\File::exists(public_path($banner->img_mobile))) {
                    \Illuminate\Support\Facades\File::delete(public_path($banner->img_mobile));
                }

                $mobileFile = $request->file('img_mobile');
                $mobileName = time() . '_mobile.' . $mobileFile->getClientOriginalExtension();
                $mobileFile->move(public_path('img/banners'), $mobileName);
                $data['img_mobile'] = 'img/banners/' . $mobileName;
            }

            $banner->update($data);

            return redirect()->route('admin.banner.editar')->with('success', 'Banner atualizado com sucesso');
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
