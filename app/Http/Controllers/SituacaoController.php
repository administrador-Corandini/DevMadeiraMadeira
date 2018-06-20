<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\situacao;
use App\carteira;
class SituacaoController extends Controller
{
    public function index(){
        $situacoes = situacao::all();
        return view('admin/situacao/index')->with('situacoes', $situacoes);
    }

    public function edit($carteiras){
        $carteira = carteira::findOrFail($carteiras);
        $situacoes = situacao::where('carteira_id',$carteiras)->get();
        return view('admin/situacao/edit')->with('situacoes', $situacoes)->with('carteira',$carteira);
    }

    public function salvarEdit(Request $request){
        $situacao = situacao::findOrFail($request->input('id'));
        $situacao->nome = strtoupper($request->input('nome'));
        $situacao->save();
        return redirect('admin/situacao/edit/'.$situacao->carteira_id);
    }
}
