<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NumeroCelular;
use App\Models\Cupom;

class CarrinhoController extends Controller
{
    public function addToCart(Request $request){

        $validacao = $request->validate([
            'img' => 'required',
            'nome' => 'required',
            'preco' => 'required'
        ]);

        $produto = $validacao;
        $produto['id'] = uniqid();

        session()->push('listaDeObjetosSession', $produto);


        return redirect()->back()->with('success', "{$request->nome} adicionado ao carrinho");

    }

    public function excluirCarrinho($id){

        $objetoLista = session('listaDeObjetosSession', []);

        $objetoLista = array_filter($objetoLista, function ($item) use ($id) {
            return $item['id'] !== $id;
        });

        session(['listaDeObjetosSession' => array_values($objetoLista)]);  
        
        return redirect()->back();
    }

    

    public function carrinho(){
        $lista = session('listaDeObjetosSession');
        $cupom = session('cupom');

        $desconto = 0;
        $subtotal = 0;
        $total = 0;
        if (!empty($lista)) {
            foreach($lista as $item){
                if($cupom){
                    $subtotal += $item['preco'];
                    $total = $subtotal - ($subtotal * ($cupom['desconto'] / 100));
                    $desconto = round($subtotal * ($cupom['desconto'] / 100), 2);
                }else{
                    $subtotal += $item['preco'];
                    $total = $subtotal;
                }   
            }
        }
        


        return view('carrinho', ['lista' => $lista, 'subtotal' => $subtotal, 'total' => $total, 'desconto' => $desconto]);
    }



    public function addCupom(Request $request){

        $request->validate([
            'cupom' => 'required|exists:cupons,cupom'
        ], [
            'cupom.required' => 'Nenhum cupom informado!',
            'cupom.exists'   => '🥲 Cupom expirado ou inexistente!',
        ]);

        $codigo = $request->input('cupom');
        $cupom = Cupom::where('cupom', $codigo)->first();

        session()->put('cupom', [
            'codigo' => $cupom->cupom,
            'desconto' => $cupom->desconto
        ]);

        return back()->with('sucesso', 'Cupom aplicado com sucesso!');

    }


    public function removeCupom(){
        session()->forget('cupom');

        return back()->with('sucesso', 'Cupom removido com sucesso!');
    }




    public function finalizando(){
        $objetoLista = session('listaDeObjetosSession', []);

        if (empty($objetoLista)) {
            return redirect()->back()->with('erroCarrinho', "Carrinho vazio, Adicione produtos!");
        } else {
            return view('finalizarCarrinho');
        }
    }


    public function whatsapp(Request $request){

        $request->validate([
            'cidade' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
        ]);
         
        $bairro = $request->input('bairro');
        $rua = $request->input('rua');
        $cidade = $request->input('cidade');
        $numeroDaCasa = $request->input('numero');

        
        $produtos = session('listaDeObjetosSession', []);

        
        if (empty($produtos)) {
            return back()->with('error', 'Nenhum produto no carrinho para enviar.');
        }

        
        $mensagem = "✅*Novo Pedido:*\n\n";
        $mensagem .= "📍*Endereço*\nㅤCidade: $cidade\nㅤRua: $rua\nㅤBairro: $bairro\nㅤNumero da Casa: $numeroDaCasa\n\n";
        $mensagem .= "📋*Produtos:*\n";

        foreach ($produtos as $produto) {
            $mensagem .= "- {$produto['nome']} (Preço: R$ {$produto['preco']})\n";
        }

        $cupom = session('cupom');
        $subtotal = 0;
        $desconto = 0;

        // calcula subtotal
        foreach ($produtos as $produto) {
            $subtotal += $produto['preco'];
        }

        // calcula desconto e total
        if ($cupom) {
            $desconto = round($subtotal * ($cupom['desconto'] / 100), 2);
            $total = $subtotal - $desconto;
            $mensagem .= "\n\n🔹*Cupom aplicado:* {$cupom['codigo']}";
        } else {
            $total = $subtotal;
        }

        $mensagem .= "\nSubtotal: R$ {$subtotal}";
        $mensagem .= "\nDesconto: -R$ {$desconto}";
        $mensagem .= "\nTotal: R$ {$total}";

        
        $mensagemCodificada = urlencode($mensagem);

        $numero = NumeroCelular::find(1);
        $numeroWhatsApp = $numero->numero; 
        $urlWhatsApp = "https://wa.me/$numeroWhatsApp?text=$mensagemCodificada";

        session()->forget('cupom');
        session()->forget('listaDeObjetosSession');
        return redirect($urlWhatsApp);
    }



    public function whatsappCombinar(){


        $produtos = session('listaDeObjetosSession', []);

        
        if (empty($produtos)) {
            return back()->with('error', 'Nenhum produto no carrinho para enviar.');
        }

        
        $mensagem = "✅*Novo Pedido:*\n\n";
        $mensagem .= "📍*Endereço*\nㅤCombinar\n\n";
        $mensagem .= "📋*Produtos:*\n";

        foreach ($produtos as $produto) {
            $mensagem .= "- {$produto['nome']} (Preço: R$ {$produto['preco']})\n";
        }

        $cupom = session('cupom');
        $subtotal = 0;
        $desconto = 0;

        // calcula subtotal
        foreach ($produtos as $produto) {
            $subtotal += $produto['preco'];
        }

        // calcula desconto e total
        if ($cupom) {
            $desconto = round($subtotal * ($cupom['desconto'] / 100), 2);
            $total = $subtotal - $desconto;
            $mensagem .= "\n\n🔹*Cupom aplicado:* {$cupom['codigo']}";
        } else {
            $total = $subtotal;
        }

        $mensagem .= "\nSubtotal: R$ {$subtotal}";
        $mensagem .= "\nDesconto: -R$ {$desconto}";
        $mensagem .= "\nTotal: R$ {$total}";


        
        $mensagemCodificada = urlencode($mensagem);

        $numero = NumeroCelular::find(1);
        $numeroWhatsApp = $numero->numero; 
        $urlWhatsApp = "https://wa.me/$numeroWhatsApp?text=$mensagemCodificada";

        session()->forget('cupom');
        session()->forget('listaDeObjetosSession');        
        return redirect($urlWhatsApp);
    }
}
