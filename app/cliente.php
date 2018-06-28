<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{

    public function telefone(){
    	return $this->hasMany('App\telefone');
    }

    public function searchTelefone($telefone){
        return $this->hasMany('App\telefone');
    }

    public function agendaHora(){
    	return $this->hasMany('App\agendaHora')->where('ativo','0')->orderBy('data');
    }

    public function email(){
    	return $this->hasMany('App\email');
    }

    public function produto(){
    	return $this->hasMany('App\produto');
    }

    public function situacao(){
        return $this->belongsTo('App\situacao');
    }

    public function getNomeAttribute($value){
        return special_ucwords($value);
    }

    public function getCpfAttribute($value){
        return maskCPFCNPJ($value);
    }

    public function inativa($carteira){
        return $this->where('carteira_id',$carteira)->update(['ativo' => 0]);
    }




    public function cadastraCliente($cpf,$nome,$fichaNova,$carteira){
        $cpf = trim($cpf);
        $nome = trim($nome);
        $carteira = $carteira;
        $busca = $this->where('CPF', $cpf)->first();

        

        if(count($busca) == 0){
            $this->CPF          = $cpf;
            $this->nome         = $nome;
            $this->carteira_id  = $carteira;
            $this->situacao_id  = $fichaNova; 
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
            $busca->ativo = 1;
            $busca->save();
            
        }
        
        return;

        
    }
}
