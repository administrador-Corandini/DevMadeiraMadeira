<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Keygen;
use App\link;
use App\marketplace;

class LinkController extends Controller
{
    public function count($id,$tip,$destino,$id_produto){
    	/*
			1 - EMAIL
			2 - WHATSAPP
			3 -	SMS
    	*/
    	$temp = explode('-', $id_produto);
    	$link = new link();
    	$link->link_random = Keygen::alphanum(10)->generate();
    	$link->cliente_id = (int) $id;
    	$link->tipo_envio_id = (int) $tip;
    	$link->destino = $destino;
    	$link->id_produto = $id_produto;
    	$link->id_markplace = (int) $temp[0];
    	$link->save();

    	if($link->tipo_envio_id == 1){//email
    		$assuntoEmail = urlencode("ASSUNTO: PESQUISA DE SATISFAÇÃO – PEDIDO $link->id_produto");
    		$mensagemEmail = urlencode(" 
										Olá,

										Conforme conversamos via telefone, segue o link para avaliação da nossa loja:
										Clique no link para avaliar -> http://www.knhit.com/mm/$link->link_random
										É muito importante para nós que sua avaliação seja positiva ao nosso produto, se possível com uma nota 5!
										Nos colocamos à sua disposição para eventuais dúvidas.

										Atenciosamente,

										-- 
										MadeiraMadeira - O Maior Home Center da Internet

										Equipe de satisfação
										Marketplace
										e-mail: satisfacao@madeiramadeira.com.br
										www.madeiramadeira.com.br
																				");
    		$linkEnvio = "https://mail.google.com/mail/u/0/?view=cm&tf=0&to=$link->destino&su=$assuntoEmail+&body=$mensagemEmail&fs=1";

    		return redirect($linkEnvio);
    	}elseif ($link->tipo_envio_id == 2) {
    		$mensagemWpp = rawurlencode("Olá,
Conforme conversamos via telefone, segue o link para avaliação da nossa loja:
clique no link para avaliar -> http://www.knhit.com/mm/$link->link_random
É muito importante para nós que sua avaliação seja positiva ao nosso produto, se possível com uma nota 5!
nos colocamos à sua disposição para eventuais dúvidas.");
    		$linkEnvio = "https://api.whatsapp.com/send?phone=55$link->destino&text=$mensagemWpp";
    		return redirect($linkEnvio);
    	}elseif ($link->tipo_envio_id == 3) {
			$linkEnvio = "Ola, Sobre seu pedido $link->id_produto $mark com a MadeiraMadeira, segue link para avaliacao http://www.knhit.com/mm/$link->link_random A nota 5 e SUPER SATISFEITO!";
    	}

    	$link->save();
		return $link;
	}

	public function identificador($link){
		$found = link::where('link_random', $link)->get()->first();

		$found->open = 1;

		$found->save();
		$marketplace = marketplace::find($found->id_markplace);
		return redirect($marketplace->link);
	}

	
}
