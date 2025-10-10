<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NumeroCelular;
use App\Models\Cupom;

class CarrinhoController extends Controller
{
    public function addToCart(Request $request){

        $validacao = $request->validate([
            'idProduto' => 'required',
            'img' => 'required',
            'nome' => 'required',
            'preco' => 'required',
            'quantidade' => 'required'
        ]);
        $produto = $validacao;
        $produto['id'] = uniqid();

        $lista = session('listaDeObjetosSession', []);
        $produtoExiste = false;
        if (!empty($lista)){
            foreach($lista as &$item){
                if($item['idProduto'] == $produto['idProduto']){
                    $item['quantidade'] += 1;
                    $produtoExiste = true;
                    break;
                }
            }
        }
        

        if(!$produtoExiste){
            $lista[] = $produto;

        }

        session(['listaDeObjetosSession' => $lista]);
        
        return redirect()->back()->with('success', "{$request->nome} adicionado ao carrinho");

    }

    public function atualizarCarrinho(Request $request){
        $productId = $request->idProduto;
        $quantity = max(1, (int) $request->quantity);
        $preCarrinho = $request->precarrinho;

        $lista = session('listaDeObjetosSession');
        $cupom = session('cupom');
        
        $desconto = 0;
        $subtotal = 0;
        $total = 0;
        if (!empty($lista)) {
 

            foreach ($lista as &$item) {
                // Atualiza só o produto que foi alterado


                if ($item['idProduto'] == $productId) {
                    $item['quantidade'] = $quantity;
                    
                }

                // Recalcula o subtotal de todos (com as quantidades corretas)
                $subtotal += $item['preco'] * $item['quantidade'];
            }

            session()->put('listaDeObjetosSession', $lista);
            session()->save();

            if($preCarrinho == "true"){
                return view('precartSumary', ['total' => $subtotal]);
            }  
            
            
            if($cupom){
                $total = $subtotal - ($subtotal * ($cupom['desconto'] / 100));
                $desconto = round($subtotal * ($cupom['desconto'] / 100), 2);
            }else{
                $total = $subtotal;
            }   
            
        }

        // Retorna apenas o HTML atualizado (sem recarregar a página)
        return view('cartSumary', compact('subtotal', 'total', 'desconto'));
    }





    public function excluirCarrinho($id){

        $objetoLista = session('listaDeObjetosSession', []);

        $objetoLista = array_filter($objetoLista, function ($item) use ($id) {
            return $item['id'] !== $id;
        });

        session(['listaDeObjetosSession' => array_values($objetoLista)]);  
        
        return redirect()->back()->with('success', "item removido do carrinho");;
    }

    

    public function carrinho(){
        $lista = session('listaDeObjetosSession');
        $cupom = session('cupom');

        if ($cupom) {
            $codigo = $cupom['codigo']; 
            $cupomMod = Cupom::where('cupom', $codigo)->first();

            $quantidade = count($lista); 

            if ($quantidade < $cupomMod->quantidade_minima) {
                $cupom = null;
                session()->forget('cupom');   
                return back()->with('erroCarrinho', "Cupom removido — é necessário ter no mínimo {$cupomMod->quantidade_minima} produtos no carrinho.");   
            }
        }
        

        $desconto = 0;
        $subtotal = 0;
        $total = 0;
        if (!empty($lista)) {
            foreach($lista as $item){
                $subtotal += $item['preco'] * $item['quantidade']; 
            }
            if($cupom){
                $total = $subtotal - ($subtotal * ($cupom['desconto'] / 100));
                $desconto = round($subtotal * ($cupom['desconto'] / 100), 2);
            }else{
                $total = $subtotal;
            }  
        }
        


        return view('carrinho', ['lista' => $lista, 'subtotal' => $subtotal, 'total' => $total, 'desconto' => $desconto, 'cupom' => $cupom]);
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

        $lista = session('listaDeObjetosSession');
        if (!empty($lista)){
            $quantidade = count($lista);
            if($quantidade < $cupom->quantidade_minima){
                return back()->with('erroCarrinho', "Este cupom exige no mínimo {$cupom->quantidade_minima} produtos no carrinho.");
            }
        }else{
            return back()->with('erroCarrinho', "Adicione produtos ao carrinho.");
        }
        

        session()->put('cupom', [
            'codigo' => $cupom->cupom,
            'desconto' => $cupom->desconto,
            'quantidade_minima' => $cupom->quantidade_minima
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
            $mensagem .= "- {$produto['quantidade']}x {$produto['nome']} (Preço: R$ {$produto['preco']})\n";
        }

        $cupom = session('cupom');
        $subtotal = 0;
        $desconto = 0;

        // calcula subtotal
        foreach ($produtos as $produto) {
            $subtotal += $produto['preco'] * $produto['quantidade'];
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
            $mensagem .= "- {$produto['quantidade']}x {$produto['nome']} (Preço: R$ {$produto['preco']})\n";
        }

        $cupom = session('cupom');
        $subtotal = 0;
        $desconto = 0;

        // calcula subtotal
        foreach ($produtos as $produto) {
            $subtotal += $produto['preco'] * $produto['quantidade'];
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
