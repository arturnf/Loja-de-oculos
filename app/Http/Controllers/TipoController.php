<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TipoProduto;

class TipoController extends Controller
{
    public function criandoTipo(Request $request){
        if(Auth::check()){
            $request->validate([
                'nome' => 'required'
            ]);

            TipoProduto::create([
                'nome' => $request->nome
            ]);

            return redirect()->route('admin.tipos')->with('success', 'Tipo Criado Com Sucesso!😁');
        }
        return redirect()->route('login.adm');
        
    }


    public function fomCriar(){
        if(Auth::check()){
            return view('adm.tipoCriar');
        }

        return redirect()->route('login.adm');
    }



    public function excluindoTipo($id){
        if(Auth::check()){
            $tipo = TipoProduto::find($id);
        
            if($tipo){
                $tipo->delete();
                return redirect()->route('admin.tipos')->with('success', 'Tipo Removido Com Sucesso!😁');
            }

            return redirect()->route('admin.tipos')->with('erro', 'Erro ao Remover Este Tipo!😥');
        }

        return redirect()->route('login.adm');

    }



    public function editarTipo($id){

        if(Auth::check()){
            $tipo = TipoProduto::find($id);
            return view('adm.tipoEditar', ['tipo' => $tipo]);
        }

        return redirect()->route('login.adm');

    }



    public function editandoTipo(Request $request, $id){
        if(Auth::check()){
            $tipo = TipoProduto::find($id);
            $request->validate([
                'nome' => 'required|string|max:255'
            ]);


            $tipo->update([
                'nome' => $request->nome
            ]);

            return redirect()->route('admin.tipos')->with('success', 'Tipo atualizado com sucesso!');

        }

        return redirect()->route('login.adm');
    }
}
