<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Colecao;
use Illuminate\Support\Facades\File;


class ColecaoController extends Controller
{
    public function inserir(){
        if(Auth::check()){
            return view('adm.colecaoCriar');
        }

        return redirect()->route('login.adm');
    }

    public function dado(Request $request){
        if(Auth::check()){
            $validatedData = $request->validate([
                'nome' => 'required',
                'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:12048', // 12KB máximo
                'descricao' => 'nullable',
            ]);
    
            if($request->hasFile('img') && $request->img->isValid()){
                 // Gera um nome único para a imagem e move para a pasta 'public/produtos'
                $imagem = $request->file('img');
                $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension(); // cria um nome único
                $caminho = public_path('colecoes'); // Caminho da pasta pública onde as imagens serão salvas
 
                 // Mova a imagem para a pasta pública
                $imagem->move($caminho, $nomeImagem);
 
                 // Define o caminho relativo para a imagem
                $caminhoImagem = 'colecoes/' . $nomeImagem;
    
                Colecao::create([
                    'nome' => $request->nome,
                    'img' => $caminhoImagem,
                    'descricao' => $request->descricao
                ]);

                return redirect()->route('admin.colecoes')->with('success', 'Coleção Criada Com Sucesso!😁');

            }

            return redirect()->route('admin.colecoes')->with('erro', 'Erro ao Criar Esta Coleção!😥');

        }
        return redirect()->route('login.adm');
    }



    public function remove($id){
        if(Auth::check()){
            $colecao = Colecao::find($id);
            if ($colecao){
                $colecao->delete();
                return redirect()->back()->with('success', 'Coleção Removida Com Sucesso!😁');
            }else{
                return redirect()->back()->with('erro', 'Erro ao Remover Esta Coleção!😥');
            }
        }

        return redirect()->route('login.adm');
        
    }




    public function editarColecao($id){
        if(Auth::check()){
            $colecao = Colecao::find($id);

            return view('adm.colecaoEditar', ['colecao' => $colecao]);
        }

        return redirect()->route('login.adm');
    }




    public function editandoColecao(Request $request, $id){
        if(Auth::check()){

            $colecao = Colecao::find($id);

            $request->validate([
                'nome' => 'required|string|max:255',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3048',
                'descricao' => 'nullable',
            ]);
            

            if($request->hasFile('img') && $request->img->isValid()){

                if(File::exists($colecao->img)){
                    File::delete($colecao->img);
                }  

                $imagem = $request->file('img');
                $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension(); // cria um nome único
                $caminho = public_path('colecoes'); // Caminho da pasta pública onde as imagens serão salvas
 
                 // Mova a imagem para a pasta pública
                if (!file_exists($caminho)) {
                    mkdir($caminho, 0777, true);  // Cria o diretório com permissões adequadas
                }

                $imagem->move($caminho, $nomeImagem);
                $caminhoImagem = 'colecoes/' . $nomeImagem;

                $colecao->update([
                    'nome' => $request->nome,
                    'img' => $caminhoImagem,
                    'descricao' => $request->descricao
                ]);

                return redirect()->route('admin.colecoes')->with('success', 'Colecao atualizada com sucesso!');
            }

            $colecao->update([
                'nome' => $request->nome,
                'descricao' => $request->descricao
            ]);

            return redirect()->route('admin.colecoes')->with('success', 'Colecao atualizada com sucesso!');
            
        }
        return redirect()->route('login.adm');
        
    }

}
