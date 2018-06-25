<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class produto extends Model
{
    function cliente (){
    	return $this->belongsTo('App\cliente');
    }

    public function marketplace(){
    	return $this->belongsTo('App\marketplace');
    }

    public function carteira(){
    	return $this->belongsTo('App\carteira');
    }

    public function cadastraProdutoSatisfacao($cliente_id,$id_produto ,$nome_produto,$data_entregue_produto,$data_prometido_pedido,$id_pedido_marketplace,$marketplace_id,$carteira_id){
        $this->cliente_id               = $cliente_id;
        $this->ativo                    = 1;
        $this->id_produto               = $id_produto;
        $this->nome                     = $nome_produto;
        $this->data_entregue_produto    = $data_entregue_produto;
        $this->data_prometido_pedido    = $data_prometido_pedido;
        $this->id_pedido_marketplace    = $id_pedido_marketplace;
        $this->marketplace_id           = $marketplace_id;
        $this->carteira_id              = $carteira_id;
        
        $this->save();
        return ;
    }

    public function cadastraProdutoTransporte($cliente_id ,$id_produto,$nome_produto,$data_SAC,$link,$loja_venda,$carteira_id){
        if($loja_venda == ''){
            $loja = 'MM';
        }
        
        $this->cliente_id               = $cliente_id;
        $this->ativo                    = 1;
        $this->id_produto               = $id_produto;
        $this->nome                     = $nome_produto;
        $this->data_SAC                 = $data_SAC;
        $this->link                     = $link;
        $this->loja_venda               = $loja_venda;
        $this->carteira_id              = $carteira_id;  
        $this->save();
        return ;
    }
}
