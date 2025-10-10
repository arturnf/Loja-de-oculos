<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cupom;
use Illuminate\Support\Facades\Auth;

class CupomController extends Controller
{
    public function listaCupom(){
        if(Auth::check()){
            $cupon = Cupom::all();

            return view('adm.cupomPainel', ['cupon' => $cupon]);
        }
        return redirect()->route('login.adm');
    }

    public function formCupom(){
        if(Auth::check()){

            return view('adm.cupomCriar');
        }
        return redirect()->route('login.adm');        
    }

    public function criarCupom(Request $request){
        if(Auth::check()){
            $request->validate([
                'cupom' => 'required',
                'desconto' => 'required',
                'quantidade_minima' => 'required'
            ]);

            Cupom::create([
                'cupom' => $request->cupom,
                'desconto' => $request->desconto,
                'quantidade_minima' => $request->quantidade_minima
            ]);
            return redirect()->route('lista.cupons')->with('success', 'Cupom Criado Com Sucesso!');
        }
        return redirect()->route('login.adm');
    }


        public function removeCupom($id){
        if(Auth::check()){
            $cupom = Cupom::find($id);
        
            if($cupom){
                $cupom->delete();
                return redirect()->route('lista.cupons')->with('success', 'Cupom Removido Com Sucesso!');
            }

            return redirect()->route('lista.cupons')->with('erro', 'Erro ao Remover Este Cupom!');
        }

        return redirect()->route('login.adm');
        
    }



    public function editarCupom($id){
        if(Auth::check()){
            $cupom = Cupom::find($id);

            return view('adm.cupomEditar', ['cupom' => $cupom]);
        }

        return redirect()->route('login.adm');
    }


    public function processEditCupom(Request $request,  $id){
        if(Auth::check()){
            $request->validate([
                'cupom' => 'required',
                'desconto' => 'required',
                'quantidade_minima' => 'required'
            ]);

            $cupom = Cupom::find($id);
            $cupom->update([
                'cupom' => $request->cupom,
                'desconto' => $request->desconto,
                'quantidade_minima' => $request->quantidade_minima
            ]);
            return redirect()->route('lista.cupons')->with('success', 'Cupom editado Com Sucesso!');
        }
        return redirect()->route('login.adm');
    }
}
