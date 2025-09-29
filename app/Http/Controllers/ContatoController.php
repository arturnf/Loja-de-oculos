<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use Illuminate\Support\Facades\Auth;
use App\Models\Produto;

class ContatoController extends Controller
{
    public function criandoContato(Request $request){
        $request->validate([
            'nome' => 'required',
            'numero' => 'required',
            'produto_id' => 'required'
        ], [
            'nome.required' => 'Preencha o campo nome',
            'numero.required' => 'Preencha o campo número',
        ]);

        Contato::create([
            'nome' => $request->nome,
            'numero' => $request->numero,
            'produto_id' => $request->produto_id
        ]);

        return redirect()->back()->with('success', 'contato enviado com sucesso');
    }




    public function mostrandoContato($id){
        if (Auth::check()) {
            $contatos = Contato::where('produto_id', $id)->get();
            $produto = Produto::where('id', $id)->first();


            return view('adm.tabelaDeContatos', ['contatos'=>$contatos, 'produto'=>$produto]);
        }
        return redirect()->route('login.adm');
    }
}
