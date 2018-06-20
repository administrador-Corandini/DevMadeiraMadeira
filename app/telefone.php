<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class telefone extends Model
{
    public function cliente(){
    	return $this->belongsTo('App\cliente');
    }

    public function SalvaTelefone($telefone,$cliente_id){

        $this->ajustaNumero($telefone);//Adiciona o numero já Ajustado
        $this->cliente_id = $cliente_id;//Define o id do clt
		$buscaTelefone = telefone::where([
			['telefone',$this->telefone],
			['cliente_id',$this->cliente_id]
		])->get();//Faz a busca se ja esta inserido
		
		if (count($buscaTelefone) == 0 and strlen($this->telefone) > 7) {
			$this->save();
		}
		return;

    }

    public function ajustaNumero($tel){
		$tel = preg_replace("/[^0-9]/", "", $tel);//Remove tudo que não for numero
		$tel = ltrim($tel,'0');//remove o 0 do começo

		if(substr($tel,0,1) == 0){
			$tel = substr($tel,1);
		}
		
		$ddd = substr($tel,0,2);
		$tel = substr($tel,2);


		if( strlen($tel) == 8 && substr($tel,0,1) >= 6){//se houver 8 digitos e for celular faz a inclusão do 9	
			$tel = $ddd."9".$tel; 
		}else{
			$tel = $ddd.$tel;
		}
		
		$this->telefone = $tel;	
		/*
		if(strlen($tel) >= 11 and strlen($tel) <= 12){
			$this->telefone = $tel;				
		}else{
			$this->telefone = null;
        }*/
        
        return;
	}
}
