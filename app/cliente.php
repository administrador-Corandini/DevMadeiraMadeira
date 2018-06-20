<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    public function telefone(){
    	return $this->hasMany('App\telefone');
    }

    public function searchTelefone($telefone){
        return $this->hasMany('App\telefone')->where('telefone','like','%'.$telefone.'%')->get();
    }

    public function agendaHora(){
    	return $this->hasMany('App\agendaHora')->where('data','>',date('Y-m-d H:i:s'))->orderBy('data');
    }

    public function email(){
    	return $this->hasMany('App\email');
    }

    public function produto(){
    	return $this->hasMany('App\produto');
    }

    public function cadastraCliente($cpf,$nome,$carteira){
        $cpf = trim($cpf);
        $nome = trim($nome);
        $carteira = $carteira;
        $busca = $this->where('CPF', $cpf)->first();

        

        if(count($busca) == 0){
            $this->CPF          = $cpf;
            $this->nome         = $nome;
            $this->carteira_id  = $carteira;
            $this->ativo    = 1;
            $this->save();

        }else{
            $this->id           = $busca->id;
            $this->CPF          = $busca->CPF;
            $this->nome         = $busca->nome;
            $this->carteira_id  = $busca->carteira_id;
            $this->situacao_id  = $busca->situacao_id;
            $this->created_at   = $busca->created_at;
            $this->updated_at   = $busca->updated_at;
        }
        
        return;

        
    }
}
