<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DateTime;
use App\link;
use App\ocorrencia;
use App\situacao;
use App\statu;
use App\cliente;
use App\remessa;
use App\produto;
use App\telefone;
use App\carteira;

class AdminController extends Controller
{
    public function index(){
    	return view('admin/index');
	}	

	public function monitorCarteira(){
		return view('admin/monitorCarteira');
	}

	public function extracao(){
		$situacao = situacao::all();
		$statusTelefone = statu::all();
		return view('admin/extracao',array ('situacoes' => $situacao,'statusTelefone' => $statusTelefone));
	}

	public function importacao(){
		$carteiras = carteira::all();
		return view('admin/importacao',['carteiras' => $carteiras]);
	}

	public function SalvaImportacao(Request $request){
		ini_set('max_execution_time',1000);
		$carteira = $request->input('carteira');

		if($carteira == 0){
			return "<h1>Selecione Uma Carteira</h1>";
		}

		$clienteDevolucao = new cliente;
		$clienteDevolucao->inativa($carteira);

		$carteiraDados = carteira::find($carteira);

		$path = public_path() . '/upload/';
		$file = $request->file;
		$file->move($path,$file->getClientOriginalName());

		$row = 1;
		////				0		  1				2				3			4				5			6				7		8			9				10
		//$header  = ['Pedido MM','Produtos','Pedido Mktplace','Loja Venda','Mês Entrega','CPF Cliente','Telefone A','Telefone B','Nome','Data entregue','Data Entrega'];
		if($handle = fopen($path.$file->getClientOriginalName(),'r')){
			while (($data = fgetcsv($handle, 2000, ";")) !== FALSE) {
				if($row > 1){
					if($carteira == 1 or $carteira == 2){
						if(strlen($data[2]) > 5){
							$aux  					= explode("-",$data[2]) ;
							$id_marketplace 		= intval($aux[0]);
							$clienteCPF 			= $data[5];
							
							$clienteNome 			= $data[8];
							$nome_produto 			= substr(trim($data[1]),0,199);
							$id_produto 			= trim($data[0]);
							$DateTimeEntregueProduto = new DateTime($data[9]);
							$data_entregue_produto 	= $DateTimeEntregueProduto->format("Y-m-d");
							$DateTimePrometido		= new DateTime($data[10]);
							$data_prometido 		= $DateTimePrometido->format('Y-m-d');
							$id_pedido_marketplace 	= $data[2];
							
							$tel1	 				= $data[6];
							$tel2					= $data[7];
							

							$cliente = new cliente;
							$cliente->cadastraCliente($clienteCPF,$clienteNome,$carteiraDados->situacao_ficha_nova,$carteira);
							
							
							$produto = new produto;
							$produto->cadastraProdutoSatisfacao($cliente->id ,$id_produto,$nome_produto,$data_entregue_produto,$data_prometido,$id_pedido_marketplace,$id_marketplace,$carteira);
							

							$telefone1 = new telefone;
							$telefone1->SalvaTelefone($tel1,$cliente->id);

							$telefone2 = new telefone;
							$telefone2->SalvaTelefone($tel2,$cliente->id);

							unset($cliente);
						}
					}elseif($carteira == 3){
						
						////				0				1			2			3				4				5					6				7			8				9			10				11	
						//$header  = ['ID PEDIDO','ID RECLAMACAO','DATA SAC','NF MADEIRA','LINK RASTREIO','CLIENTE TELEFONE','CLIENTE TELEFONE 2','ID PEDPED','DESCRICAO','NOME CLIENTE','CPF CLIENTE','LOJA VENDA'];
						$clienteCPF 			= trim($data[10]);
						$clienteNome			= trim($data[9]);

						$produtoIDReclamacao	= $data[1];
						$produtoDataSAC 		= $data[2];
						$produtoNF				= $data[3];
						$produtoLink			= $data[4];
						$produtoIDPedido		= $data[7];
						$produtoDescricao		= $data[8];
						$produtoLJVenda			= $data[11];

						$tel1 					= $data[5];
						$tel2					= $data[6];
						
						$cliente = new cliente;
						$cliente->cadastraCliente($clienteCPF,$clienteNome,$carteiraDados->situacao_ficha_nova,$carteira);

						$produto = new produto;
						$produto->cadastraProdutoTransporte($cliente->id ,$produtoIDPedido,$produtoDescricao,$produtoDataSAC,$produtoLink,$produtoLJVenda,$carteira,$produtoIDReclamacao);

						$telefone1 = new telefone;
						$telefone1->SalvaTelefone($tel1,$cliente->id);

						$telefone2 = new telefone;
						$telefone2->SalvaTelefone($tel2,$cliente->id);

					}	
				
				}

				$row++;
			}
		}

		fclose($handle);
		
	}

    public function ocorrencia(){

    	$quantiOcorrencia = DB::SELECT(DB::raw('SELECT DISTINCT users.name AS user,	COUNT(ocorrencias.id) AS "quant" FROM ocorrencias INNER JOIN users ON users.id = ocorrencias.user_id WHERE ocorrencias.created_at BETWEEN CONCAT(CURRENT_DATE(), " 00:00:00") AND CONCAT(CURRENT_DATE(), " 23:00:00") GROUP BY USER_ID,users.name ORDER BY quant DESC'));
    	$quantiOcorrenciaSituacao = DB::SELECT(DB::raw('SELECT DISTINCT situacoes.nome as situacao,COUNT(ocorrencias.id) as quant from ocorrencias INNER JOIN situacoes ON ocorrencias.situacao_id = situacoes.id WHERE ocorrencias.created_at BETWEEN CONCAT( CURRENT_DATE()," 00:00:00") and CONCAT(CURRENT_DATE() ," 23:00:00") GROUP BY situacoes.nome ORDER BY quant desc'));
    	
    	$totalOcorrencia = ocorrencia::whereBetween('created_at',[date("Y-m-d").' 00:00:00',date("Y-m-d").' 23:59:59'])->count();

    	return view('admin/ocorrencia',['quantiOcorrencia' => $quantiOcorrencia,'totalOcorrencia' => $totalOcorrencia,'quantiOcorrenciaSituacao' => $quantiOcorrenciaSituacao]);
    }

    public function clicks(){

		$links_abertos =  DB::select( DB::raw("SELECT DISTINCT tipo_envio_id,COUNT(links.id) AS enviados,sum(open) as abertos from links WHERE links.created_at BETWEEN CONCAT(CURRENT_DATE(),' 00:00:00') AND CONCAT(CURRENT_DATE(),' 23:59:59') GROUP BY tipo_envio_id") );		
		return $links_abertos;
		$links = link::whereBetween('created_at',[date("Y-m-d").' 00:00:00',date("Y-m-d").' 23:59:59'])->paginate(30);
		$total = DB::select( DB::raw("SELECT COUNT(id) as quanti from links WHERE created_at BETWEEN CONCAT(CURRENT_DATE(),' 00:00:00')and CONCAT(CURRENT_DATE(),' 23:59:59')
										UNION
									SELECT COUNT(id) as quanti from links WHERE created_at BETWEEN CONCAT(CURRENT_DATE(),' 00:00:00')and CONCAT(CURRENT_DATE(),' 23:59:59') and open = 1"));
		
		return view('admin/clicks',['links_abertos' => $links_abertos,'links' => $links,'total' => $total]);
	}
}
