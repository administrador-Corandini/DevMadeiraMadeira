<?php

use Illuminate\Database\Seeder;
use App\User;
use App\cliente;
use App\telefone;
use App\email;
use App\Marketplace;
use App\produto;
use App\statu;
use App\ocorrencia;
use App\tipoEnvio;
use App\link;
use App\situacao;
use App\carteira;
use App\wpp;

class DatabaseSeeder extends Seeder
{

    public function run()
    {   
        $this->call('userTableSeeder');
        $this->call('carteiraTableSeeder');
        $this->call('wppTableSeeder');
        $this->call('situacaoTableSeeder');
        $this->call('ClientesTableSeeder');
        $this->call('StatusTableSeeder');
        $this->call('TelefonesTableSeeder');
        $this->call('emailsTableSeeder');
        $this->call('MarketplacesTableSeeder');
        $this->call('ProdutosTableSeeder');
        $this->call('OcorrenciasTableSeeder');
        $this->call('TipoEnviosTableSeeder');
        $this->call('LinkTableSeeder');
        
    }
}
class userTableSeeder extends Seeder
{

    public function run()
    {
       user::create(['name' => 'admin','email' => 'administrador@corandini.com.br','password' => bcrypt('741852')]); 
    }
}

class carteiraTableSeeder extends Seeder
{

    public function run()
    {
       carteira::create(['nome' => 'MADEIRA MADEIRA']); 
       carteira::create(['nome' => 'CASA 41']);
       carteira::create(['nome' => 'TRANSPORTE']);  
    }
}

class wppTableSeeder extends Seeder
{

    public function run()
    {
       wpp::create(['nome' => 'NÃO INFORMADO']); 
       wpp::create(['nome' => 'NÃO FOI NECESSARIO']);
       wpp::create(['nome' => 'COM SUCESSO']); 
       wpp::create(['nome' => 'NÃO É DO CLIENTE']); 
       wpp::create(['nome' => 'NÃO POSSUI WPP']); 
    }
}

class ClientesTableSeeder extends Seeder
{

    public function run()
    {
       cliente::create(['nome'=> 'ANDREY RAFAH','CPF' => '07420746923','carteira_id' => 1]);
       cliente::create(['nome'=> 'JOÃO DA SILVA','CPF' => '74125898711','carteira_id' => 1]);
    }
}

class TelefonesTableSeeder extends Seeder
{

    public function run()
    {
       telefone::create(['cliente_id'=> 1,'telefone' => '41992327183','status_id' => '2']);
       telefone::create(['cliente_id'=> 1,'telefone' => '41335861385','status_id' => '3']);
       telefone::create(['cliente_id'=> 2,'telefone' => '41358613852','status_id' => '1']);
       telefone::create(['cliente_id'=> 2,'telefone' => '41888888888','status_id' => '4']);
    }
}

class emailsTableSeeder extends Seeder
{

    public function run()
    {
       email::create(['cliente_id'=> 1,'email' => 'andrey.rafah@corandini.com.br','status_id' => '2']);
       email::create(['cliente_id'=> 1,'email' => 'andrey_rafah@hotmail.com','status_id' => '3']);
    }
}

class MarketplacesTableSeeder extends Seeder
{

    public function run()
    {
       marketplace::create(['nome'=> 'SHOPTIME','link' => 'https://goo.gl/CLtgXQ', 'carteira_id' => 1]); 
       marketplace::create(['nome'=> 'AMERICANAS','link' => 'https://goo.gl/y0FJY6', 'carteira_id' => 1]); 
       marketplace::create(['nome'=> 'SUBMARINO','link' => 'https://goo.gl/MJvdoU', 'carteira_id' => 1]);

       marketplace::create(['nome'=> 'SHOPTIME','link' => 'https://goo.gl/CLtgXQ', 'carteira_id' => 2]); 
       marketplace::create(['nome'=> 'AMERICANAS','link' => 'https://goo.gl/y0FJY6', 'carteira_id' => 2]); 
       marketplace::create(['nome'=> 'SUBMARINO','link' => 'https://goo.gl/MJvdoU', 'carteira_id' => 2]); 
       
    }
}

class ProdutosTableSeeder extends Seeder
{

    public function run()
    {
       produto::create(['cliente_id'=> 1,
                        'id_produto' => '140103',
                        'nome' => 'Cômoda 16D131 Rodial',
                        'id_pedido_marketplace' => '02-646172472',
                        'marketplace_id' => 2,
                        'data_entregue_produto' => '2017-12-12',
                        'data_prometido_pedido' => '2017-12-12', 
                        'carteira_id' => 1]); 
    }
}

class StatusTableSeeder extends Seeder
{

    public function run()
    {
       statu::create(['status' => 'NÃO INFORMADO']); 
       statu::create(['status' => 'HOT']); 
       statu::create(['status' => 'NÃO PERTENCE AO CLT']); 
       statu::create(['status' => 'NÃO EXISTE']);
       statu::create(['status' => 'NÃO INFORMADO - PESQUISA']);
       statu::create(['status' => 'REFERENCIA']);
       statu::create(['status' => 'CAIXA DE MENSAGEM']);
       
    }
}

class OcorrenciasTableSeeder extends Seeder
{

    public function run()
    {
      ocorrencia::create(['cliente_id' => '1','situacao_id' => 1, 'ocorrencia' => 'No meu xinélo da humildade eu gostaria muito de ver o Neymar e o Ganso. Por que eu acho que.... 11 entre 10 brasileiros gostariam. Você veja, eu já vi, parei de ver. Voltei a ver, e acho que o Neymar e o Ganso têm essa capacidade de fazer a gente olhar.']); 
      ocorrencia::create(['cliente_id' => '1', 'situacao_id' => 1,'ocorrencia' => 'A única área que eu acho, que vai exigir muita atenção nossa, e aí eu já aventei a hipótese de até criar um ministério. É na área de... Na área... Eu diria assim, como uma espécie de analogia com o que acontece na área agrícola.']); 
      ocorrencia::create(['cliente_id' => '1','situacao_id' => 1, 'ocorrencia' => 'Ai você fala o seguinte: "- Mas vocês acabaram isso?" Vou te falar: -"Não, está em andamento!" Tem obras que "vai" durar pra depois de 2010. Agora, por isso, nós já não desenhamos, não começamos a fazer projeto do que nós "podêmo fazê"? 11, 12, 13, 14... Por que é que não?']); 

    }
}

class TipoEnviosTableSeeder extends Seeder
{

    public function run()
    {
       tipoenvio::create(['tipo' => 'EMAIL']); 
       tipoenvio::create(['tipo' => 'WHATSAPP']); 
       tipoenvio::create(['tipo' => 'SMS']); 
    }
}

class LinkTableSeeder extends Seeder
{

    public function run()
    {
       link::create(['link_random' => '0i52ODXUP9', 'cliente_id' => 1, 'tipo_envio_id' => 1, 'id_produto' => '02-646172472' , 'id_markplace' => 2 ,'destino' => 'andrey.rafah@corandini.com.br']); 
       link::create(['link_random' => 'e24lzBEKG3', 'cliente_id' => 1, 'tipo_envio_id' => 2, 'id_produto' => '02-646172472' , 'id_markplace' => 2 ,'destino' => '41992327183']); 
       link::create(['link_random' => 'ubF6JdgICW', 'cliente_id' => 1, 'tipo_envio_id' => 3, 'id_produto' => '02-646172472' , 'id_markplace' => 2 ,'destino' => '41992327183']); 
    }
}

class situacaoTableSeeder extends Seeder
{

    public function run()
    {
       situacao::create(['nome' => 'FICHA NOVA/CLIENTE NÃO ATENDE','carteira_id' => 1]); //1
       situacao::create(['nome' => 'ENVIADO LINK DE AVALIAÇÃO','carteira_id' => 1]); //2
       situacao::create(['nome' => 'NÃO TEM INTERESSE EM AVALIAR','carteira_id' => 1]); ///3
       situacao::create(['nome' => 'PROBLEMA COM O PRODUTO','carteira_id' => 1]); //4
       situacao::create(['nome' => 'PROBLEMA COM A ENTREGA','carteira_id' => 1]); //5
       situacao::create(['nome' => 'CLIENTE JÁ FEZ A AVALIAÇÃO','carteira_id' => 1]); //6
       situacao::create(['nome' => 'SEM CONTATO','carteira_id' => 1]);//7
       situacao::create(['nome' => 'PRODUTO NÃO MONTADO','carteira_id' => 1]); //8
       situacao::create(['nome' => 'CLT NÃO PODE FALAR AGORA','carteira_id' => 1]); //9
       situacao::create(['nome' => '2x LINK AVALIAÇÃO','carteira_id' => 1]);//10
       
       situacao::create(['nome' => 'FICHA NOVA/CLIENTE NÃO ATENDE','carteira_id' => 2]); //1
       situacao::create(['nome' => 'ENVIADO LINK DE AVALIAÇÃO','carteira_id' => 2]); //2
       situacao::create(['nome' => 'NÃO TEM INTERESSE EM AVALIAR','carteira_id' => 2]); ///3
       situacao::create(['nome' => 'PROBLEMA COM O PRODUTO','carteira_id' => 2]); //4
       situacao::create(['nome' => 'PROBLEMA COM A ENTREGA','carteira_id' => 2]); //5
       situacao::create(['nome' => 'CLIENTE JÁ FEZ A AVALIAÇÃO','carteira_id' => 2]); //6
       situacao::create(['nome' => 'SEM CONTATO','carteira_id' => 2]);//7
       situacao::create(['nome' => 'PRODUTO NÃO MONTADO','carteira_id' => 2]); //8
       situacao::create(['nome' => 'CLT NÃO PODE FALAR AGORA','carteira_id' => 2]); //9
       situacao::create(['nome' => '2x LINK AVALIAÇÃO','carteira_id' => 2]);//10

       situacao::create(['nome' => 'FICHA NOVA/CLIENTE NÃO ATENDE','carteira_id' => 3]); //1
       situacao::create(['nome' => 'INFORMAÇÕES ATUALIZADAS','carteira_id' => 3]); //2
       situacao::create(['nome' => 'CLIENTE NÃO TEM NOVAS INFORMAÇÕES','carteira_id' => 3]); ///3
       situacao::create(['nome' => 'CLIENTE QUER CANCELAR COMPRA','carteira_id' => 3]); //4
       situacao::create(['nome' => 'RETORNAR MAIS TARDE','carteira_id' => 3]); //5
       situacao::create(['nome' => 'CLIENTE JÁ RECEBEU PRODUTO','carteira_id' => 3]); //6
       situacao::create(['nome' => 'SEM CONTATO','carteira_id' => 3]);//7
       situacao::create(['nome' => 'CLIENTE ALEGA NÃO TER FEITO A COMPRA','carteira_id' => 3]); //8
       situacao::create(['nome' => 'PESQUISA SEM SUCESSO/TENTATIVAS ESGOTADAS','carteira_id' => 3]); //9
       situacao::create(['nome' => 'FEEDBACK MADEIRA/EMAIL ENVIADO MADEIRA','carteira_id' => 3]);//10
    }
}
