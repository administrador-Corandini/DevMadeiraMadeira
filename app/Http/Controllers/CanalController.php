<?php

namespace App\Http\Controllers;

use App\canal;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Request;

class CanalController extends Controller
{

    public function index()
    {
        $canal = canal::all();
        return view('canal.index')->with('canal', $canal);
    }

    public function create()
    {
        return view('canal.create');
    }


    public function store(Request $request)
    {

        $rules = array(
            'nome'       => 'required'
        );
        
        
        $messages = [
            'nome.required' => "Opa é necessario preencher a ocorrencia"
        ];

        $validator = Validator::make(Request::all(), $rules,$messages);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('cliente/canal/create')
                ->withErrors($validator);
        } else {
            
            $canal = new canal;
            $canal->nome       = Request::input('nome');
            $canal->save();

            $canal = canal::all();
            return Redirect::to('cliente/canal');
        }

    }


    public function edit(canal $canal)
    {
        //
    }

    public function update(Request $request, canal $canal)
    {
        //
    }

}
