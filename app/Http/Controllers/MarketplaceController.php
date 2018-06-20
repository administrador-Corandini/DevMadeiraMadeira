<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\marketplace;
use App\carteira;

class MarketplaceController extends Controller
{
    public function index(){
        $marketplaces = marketplace::all();
        return view('admin/marketplace/index')->with('marketplaces' , $marketplaces);
    }

    public function edit($carteiras){
        $carteira = carteira::findOrFail($carteiras);
        $marketplaces = marketplace::where('carteira_id',$carteiras)->get();
        return view('admin/marketplace/edit')->with('marketplaces', $marketplaces)->with('carteira',$carteira);
    }

    public function salvarEdit(Request $request){
        $marketplace = marketplace::findOrFail($request->input('id'));
        $marketplace->nome = strtoupper($request->input('nome'));
        $marketplace->save();
        return redirect('admin/marketplace/edit/'.$marketplace->carteira_id);
    }
}
