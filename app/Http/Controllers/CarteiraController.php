<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\carteira;

class CarteiraController extends Controller
{
    public function index(){
        $carteiras = carteira::all();
        return view('admin/carteira/index')->with('carteiras' , $carteiras);
    }

    public function edit($id){
        $carteira = carteira::findOrFail($id);
        return view('admin/carteira/edit')->with('carteira' , $carteira);
    }

    public function salvarEdit(Request $request){
        $carteira = carteira::findOrFail($request->input('id'));
        $carteira->nome = strtoupper($request->input('nome'));
        $carteira->save();
        return redirect('admin/carteira/'.$carteira->id.'/edit');
    }
}
