<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colecao;
use App\Models\Produto;
use App\Models\TipoProduto;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function inserir()
    {
        if (Auth::check()) {
            $tipo = TipoProduto::all();
            $colecoes = Colecao::all();
            return view('adm.produto.produtoCriar', compact('colecoes', 'tipo'));
        }

        return redirect()->route('login.adm');
    }

    public function capturando(Request $request)
    {
        if (Auth::check()) {

            $request->validate([
                'nome' => 'required',
                'preco' => 'required',
                'tipo' => 'required',
                'colecao' => 'nullable|exists:colecaos,id',
                'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:3048', // 3MB máximo
                'img2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3048', // 3MB máximo
                'img3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3048', // 3MB máximo
            ]);


            if ($request->hasFile('img') && $request->img->isValid()) {
                // Gera um nome único para a imagem e move para a pasta 'public/produtos'
                $imagem = $request->file('img');
                $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension(); // cria um nome único
                $caminho = public_path('produtos'); // Caminho da pasta pública onde as imagens serão salvas



                // Mova a imagem para a pasta pública
                if (!file_exists($caminho)) {
                    mkdir($caminho, 0777, true);  // Cria o diretório com permissões adequadas
                }
                $imagem->move($caminho, $nomeImagem);

                // Define o caminho relativo para a imagem
                $caminhoImagem = 'produtos/' . $nomeImagem;
                $caminhoImagem2 = null;
                $caminhoImagem3 = null;
                $preco = (float) $request->input('preco');




                if ($request->hasFile('img3') && $request->hasFile('img2')) {
                    $imagem2 = $request->file('img2');
                    $nomeImagem2 = time() + 1 . '.' . $imagem2->getClientOriginalExtension(); // cria um nome único

                    $imagem2->move($caminho, $nomeImagem2);
                    $caminhoImagem2 = 'produtos/' . $nomeImagem2;

                    $imagem3 = $request->file('img3');
                    $nomeImagem3 = time() + 2 . '.' . $imagem3->getClientOriginalExtension(); // cria um nome único

                    $imagem3->move($caminho, $nomeImagem3);
                    $caminhoImagem3 = 'produtos/' . $nomeImagem3;

                    Produto::create([
                        'nome' => $request->nome,
                        'img' => $caminhoImagem,
                        'preco' => $preco,
                        'colecao_id' => $request->colecao,
                        'descricao' => 'vazio',
                        'tipoproduto_id' => $request->tipo,
                        'img2' => $caminhoImagem2,
                        'img3' => $caminhoImagem3,
                    ]);
                    return redirect()->route('admin')->with('success', 'Produto Criado Com Sucesso!');
                }


                if ($request->hasFile('img2')) {
                    $imagem2 = $request->file('img2');
                    $nomeImagem2 = time() + 1 . '.' . $imagem2->getClientOriginalExtension(); // cria um nome único

                    $imagem2->move($caminho, $nomeImagem2);
                    $caminhoImagem2 = 'produtos/' . $nomeImagem2;
                    Produto::create([
                        'nome' => $request->nome,
                        'img' => $caminhoImagem,
                        'preco' => $preco,
                        'colecao_id' => $request->colecao,
                        'descricao' => 'vazio',
                        'tipoproduto_id' => $request->tipo,
                        'img2' => $caminhoImagem2,
                    ]);
                    return redirect()->route('admin')->with('success', 'Produto Criado Com Sucesso!');
                }


                if ($request->hasFile('img3')) {
                    $imagem3 = $request->file('img3');
                    $nomeImagem3 = time() + 1 . '.' . $imagem3->getClientOriginalExtension(); // cria um nome único

                    $imagem3->move($caminho, $nomeImagem3);
                    $caminhoImagem3 = 'produtos/' . $nomeImagem3;

                    Produto::create([
                        'nome' => $request->nome,
                        'img' => $caminhoImagem,
                        'preco' => $preco,
                        'colecao_id' => $request->colecao,
                        'descricao' => 'vazio',
                        'tipoproduto_id' => $request->tipo,
                        'img3' => $caminhoImagem3,
                    ]);
                    return redirect()->route('admin')->with('success', 'Produto Criado Com Sucesso!');
                }


                Produto::create([
                    'nome' => $request->nome,
                    'img' => $caminhoImagem,
                    'preco' => $preco,
                    'colecao_id' => $request->colecao,
                    'descricao' => 'vazio',
                    'tipoproduto_id' => $request->tipo,
                ]);

                return redirect()->route('admin')->with('success', 'Produto Criado Com Sucesso!');
            }
        }

        return redirect()->route('login.adm');
    }



    public function removeProduto($id)
    {
        if (Auth::check()) {
            $produto = Produto::find($id);

            if ($produto) {
                $produto->delete();
                return redirect()->route('admin')->with('success', 'Produto Removido Com Sucesso!');
            }

            return redirect()->route('admin')->with('error', 'Erro ao Remover Este Produto!');
        }

        return redirect()->route('login.adm');
    }







    public function editarProdutos($id)
    {
        if (Auth::check()) {
            $tipo = TipoProduto::all();
            $produto = Produto::find($id);
            $colecoes = Colecao::all();

            return view('adm.produto.produtoAtualizar', ['produto' => $produto, 'tipo' => $tipo, 'colecoes' => $colecoes]);
        }

        return redirect()->route('login.adm');
    }


    public function editandoProduto(Request $request, $id)
    {
        if (Auth::check()) {

            $produto = Produto::find($id);

            $request->validate([
                'nome' => 'required|string|max:255',
                'preco' => 'required|numeric',
                'esgotado' => 'required',
                'colecao' => 'required',
                'tipo' => 'required',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3048', // 3MB máximo
                'img2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3048', // 3MB máximo
                'img3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3048', // 3MB máximo
            ]);

            $preco = (float) $request->input('preco');

            if ($request->hasFile('img') && $request->img->isValid()) {
                if (File::exists($produto->img)) {
                    File::delete($produto->img);
                }

                $imagem = $request->file('img');
                $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension(); // cria um nome único
                $caminho = public_path('produtos'); // Caminho da pasta pública onde as imagens serão salvas

                // Mova a imagem para a pasta pública
                if (!file_exists($caminho)) {
                    mkdir($caminho, 0777, true);  // Cria o diretório com permissões adequadas
                }
                $imagem->move($caminho, $nomeImagem);


                // Define o caminho relativo para a imagem
                $caminhoImagem = 'produtos/' . $nomeImagem;
                if ($request->hasFile('img3') && $request->hasFile('img2')) {
                    if (File::exists($produto->img2)) {
                        File::delete($produto->img2);
                    }
                    if (File::exists($produto->img3)) {
                        File::delete($produto->img3);
                    }
                    $imagem2 = $request->file('img2');
                    $nomeImagem2 = time() + 1 . '.' . $imagem2->getClientOriginalExtension(); // cria um nome único

                    $imagem2->move($caminho, $nomeImagem2);
                    $caminhoImagem2 = 'produtos/' . $nomeImagem2;

                    $imagem3 = $request->file('img3');
                    $nomeImagem3 = time() + 2 . '.' . $imagem3->getClientOriginalExtension(); // cria um nome único

                    $imagem3->move($caminho, $nomeImagem3);
                    $caminhoImagem3 = 'produtos/' . $nomeImagem3;

                    $produto->update([
                        'nome' => $request->nome,
                        'img' => $caminhoImagem,
                        'preco' => $preco,
                        'colecao_id' => $request->colecao,
                        'descricao' => 'vazio',
                        'tipoproduto_id' => $request->tipo,
                        'img2' => $caminhoImagem2,
                        'img3' => $caminhoImagem3,
                    ]);
                    return redirect()->route('admin')->with('success', 'Produto Atualizado Com Sucesso!');
                }

                if ($request->hasFile('img2')) {
                    if (File::exists($produto->img2)) {
                        File::delete($produto->img2);
                    }
                    $imagem2 = $request->file('img2');
                    $nomeImagem2 = time() + 1 . '.' . $imagem2->getClientOriginalExtension(); // cria um nome único

                    $imagem2->move($caminho, $nomeImagem2);
                    $caminhoImagem2 = 'produtos/' . $nomeImagem2;

                    $produto->update([
                        'nome' => $request->nome,
                        'img' => $caminhoImagem,
                        'preco' => $preco,
                        'colecao_id' => $request->colecao,
                        'descricao' => 'vazio',
                        'tipoproduto_id' => $request->tipo,
                        'img2' => $caminhoImagem2,
                    ]);
                    return redirect()->route('admin')->with('success', 'Produto Atualizado Com Sucesso!');
                }

                if ($request->hasFile('img3')) {
                    if (File::exists($produto->img3)) {
                        File::delete($produto->img3);
                    }
                    $imagem3 = $request->file('img3');
                    $nomeImagem3 = time() + 1 . '.' . $imagem3->getClientOriginalExtension(); // cria um nome único

                    $imagem3->move($caminho, $nomeImagem3);
                    $caminhoImagem3 = 'produtos/' . $nomeImagem3;

                    $produto->update([
                        'nome' => $request->nome,
                        'img' => $caminhoImagem,
                        'preco' => $preco,
                        'colecao_id' => $request->colecao,
                        'descricao' => 'vazio',
                        'tipoproduto_id' => $request->tipo,
                        'img3' => $caminhoImagem3,
                    ]);
                    return redirect()->route('admin')->with('success', 'Produto Atualizado Com Sucesso!');
                }


                $produto->update([
                    'nome' => $request->nome,
                    'img' => $caminhoImagem,
                    'preco' => $preco,
                    'esgotado' => $request->esgotado,
                    'tipoproduto_id' => $request->tipo
                ]);

                return redirect()->route('admin')->with('success', 'Produto atualizado com sucesso!');
            }


            if ($request->hasFile('img3') && $request->hasFile('img2')) {
                if (File::exists($produto->img2)) {
                    File::delete($produto->img2);
                }
                if (File::exists($produto->img3)) {
                    File::delete($produto->img3);
                }
                $imagem2 = $request->file('img2');
                $nomeImagem2 = time() + 1 . '.' . $imagem2->getClientOriginalExtension(); // cria um nome único
                $caminho = public_path('produtos'); // Caminho da pasta pública onde as imagens serão salvas

                $imagem2->move($caminho, $nomeImagem2);
                $caminhoImagem2 = 'produtos/' . $nomeImagem2;

                $imagem3 = $request->file('img3');
                $nomeImagem3 = time() + 2 . '.' . $imagem3->getClientOriginalExtension(); // cria um nome único

                $imagem3->move($caminho, $nomeImagem3);
                $caminhoImagem3 = 'produtos/' . $nomeImagem3;

                $produto->update([
                    'nome' => $request->nome,
                    'preco' => $preco,
                    'colecao_id' => $request->colecao,
                    'descricao' => 'vazio',
                    'tipoproduto_id' => $request->tipo,
                    'img2' => $caminhoImagem2,
                    'img3' => $caminhoImagem3,
                ]);
                return redirect()->route('admin')->with('success', 'Produto Atualizado Com Sucesso!');
            }

            if ($request->hasFile('img2')) {
                if (File::exists($produto->img2)) {
                    File::delete($produto->img2);
                }
                $imagem2 = $request->file('img2');
                $nomeImagem2 = time() + 1 . '.' . $imagem2->getClientOriginalExtension(); // cria um nome único
                $caminho = public_path('produtos'); // Caminho da pasta pública onde as imagens serão salvas

                $imagem2->move($caminho, $nomeImagem2);
                $caminhoImagem2 = 'produtos/' . $nomeImagem2;

                $produto->update([
                    'nome' => $request->nome,
                    'preco' => $preco,
                    'colecao_id' => $request->colecao,
                    'descricao' => 'vazio',
                    'tipoproduto_id' => $request->tipo,
                    'img2' => $caminhoImagem2,
                ]);
                return redirect()->route('admin')->with('success', 'Produto Atualizado Com Sucesso!');
            }

            if ($request->hasFile('img3')) {
                if (File::exists($produto->img3)) {
                    File::delete($produto->img3);
                }
                $imagem3 = $request->file('img3');
                $nomeImagem3 = time() + 1 . '.' . $imagem3->getClientOriginalExtension(); // cria um nome único
                $caminho = public_path('produtos'); // Caminho da pasta pública onde as imagens serão salvas

                $imagem3->move($caminho, $nomeImagem3);
                $caminhoImagem3 = 'produtos/' . $nomeImagem3;

                $produto->update([
                    'nome' => $request->nome,
                    'preco' => $preco,
                    'colecao_id' => $request->colecao,
                    'descricao' => 'vazio',
                    'tipoproduto_id' => $request->tipo,
                    'img3' => $caminhoImagem3,
                ]);
                return redirect()->route('admin')->with('success', 'Produto Atualizado Com Sucesso!');
            }

            $produto->update([
                'nome' => $request->nome,
                'preco' => $preco,
                'esgotado' => $request->esgotado,
                'colecao_id' => $request->colecao,
                'tipoproduto_id' => $request->tipo
            ]);

            return redirect()->route('admin')->with('success', 'Produto atualizado com sucesso!');
        }
        return redirect()->route('login.adm');
    }
}
