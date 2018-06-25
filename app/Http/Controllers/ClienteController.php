<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
//use Illuminate\Http\Request;
use Request;
use App\User;
use App\Cliente;
Use App\statu;
use App\ocorrencia;
use App\telefone;
use App\situacao;
use App\email;
use App\wpp;
use App\agendaHora;

class ClienteController extends Controller
{
  public function show($id){
    $agendaHora = agendahora::where('data','<=',date('Y-m-d H:i:s'))->where('ativo',0)->orderBy('data')->get();
   	$cliente = Cliente::findOrFail($id);
    $ocorrencia = ocorrencia::where('cliente_id', $id)->orderBy('created_at','DESC')->paginate(3);
    $status = statu::all();
    $situacao = situacao::where('carteira_id',$cliente->carteira_id)->get();
    $wpp = wpp::all();
     //return view('cliente/show',['cliente' => $cliente,'status' => $status,'ocorrencia' => $ocorrencia, 'situacao' => $situacao , 'wpp' => $wpp]);
     return view('cliente/show')->with('cliente', $cliente)->with('status', $status)->with('ocorrencia', $ocorrencia)->with('situacao' , $situacao)->with('wpp' , $wpp)->with('agendaHora',$agendaHora);
  }

  public function create(){
    return view('cliente/create');
  }

  public function search(){
    $cpf   = Request::input('CPF');
    $name  = Request::input('name');
    $tel = Request::input('tel');

    if( isset($cpf) )
      $cliente = cliente::where('cpf','like','%'.$cpf.'%')->paginate(30);
    

    if(isset($name))
      $cliente = cliente::where('nome','like','%'.$name.'%')->paginate(30);

    if(isset($tel)){
      $cliente = new cliente;
      $cliente = DB::select("select clientes.* from clientes inner join telefones on telefones.cliente_id = clientes.id where telefone like ?",['%'.$tel.'%']);
    }

    return view('cliente/search')->with('cliente', $cliente);
  }

   public function list(){
    $situacao = situacao::where('prioridade','>','0')->orderBy('prioridade')->get();
    $situacoes = array();
    
    foreach($situacao as $s){
      $situacoes[] = $s->id;
    }
    $agendaHora = agendahora::where('data','<=',date('Y-m-d H:i:s'))->where('ativo','0')->orderBy('data')->get();
    $fichas = Cliente::whereIn('situacao_id',[$situacoes])->paginate(30);
    return view('cliente/list')->with('fichas', $fichas)->with('agendaHora',$agendaHora);
   }

  public function addTelefone($id){
    $status = statu::all();
    return view('cliente/addTelefone',array('id' => $id,'status' => $status, 'cliente_id' => $id));
  }

  public function salvaAddTelefone(){
    $telefone   = Request::input('telefone');
    $status_id  = Request::input('status_id');
    $cliente_id = Request::input('cliente_id');

    if($telefone <> null and $cliente_id <> null and $status_id <> null){
      DB::insert('INSERT INTO telefones (cliente_id,telefone,status_id) VALUES (?,?,?)',array($cliente_id,$telefone,$status_id));
    }
    
    return redirect('/cliente/view/'.$cliente_id);
  }

  public function addEmail($id){
    $status = statu::all();
    return view('cliente/addEmail',array('id' => $id,'status' => $status, 'cliente_id' => $id));
  }

  public function salvaAddEmail(){
    $email   = Request::input('email');
    $status_id  = Request::input('status_id');
    $cliente_id = Request::input('cliente_id');

    if($email <> null and $cliente_id <> null and $status_id <> null){
      DB::insert('INSERT INTO emails (cliente_id,email,status_id) VALUES (?,?,?)',array($cliente_id,$email,$status_id));
    }
    
    //return $email.$cliente_id.$status_id;
    return redirect('/cliente/view/'.$cliente_id);
  }


  public function agendaHoraList(){
    $agendaHora = agendahora::where('ativo',0)->orderBy('data')->paginate(30);
    return view('cliente/agendaHora')->with('agendaHora',$agendaHora);
  }

  public function agendaHora(){
    
    $cliente_id = Request::input('cliente_id');
    $data = Request::input('dataLembrete')." ".Request::input('horaLembrete');
    $agenda = new agendaHora;
    $agenda->data       = $data;
    $agenda->cliente_id = $cliente_id;
    $agenda->user_id    = Request::input('user_id');
    $agenda->save();
  
    return redirect('/cliente/view/'.$cliente_id);
  }

  public function agendaHoraID($id){
    $agendaHora = agendaHora::find($id);
    $agendaHora->ativo = 1;  
    $agendaHora->save();
    echo $agendaHora;
    return redirect('cliente/agendaHora');
  }

  public function salvaOcorrencia(){

    $ocorrencia = new ocorrencia;
    $ocorrencia->cliente_id = Request::input('cliente_id');
    $ocorrencia->ocorrencia = Request::input('ocorrencia');
    $ocorrencia->situacao_id = Request::input('situacao');
    $ocorrencia->user = Request::input('user');


    $cliente = cliente::find(Request::input('cliente_id'));
    $cliente->situacao_id = Request::input('situacao');
    //$cliente->

    if($ocorrencia <> null){
      $cliente->save();
      $ocorrencia->save();
    }

    return redirect('/cliente/view/'.$cliente->id);
  }

  public function salvaTelefone(){
    $telefone = telefone::find(Request::input('id'));
    $telefone->telefone = Request::input('telefone');
    $telefone->status_id = Request::input('status_id');
    $telefone->wpp_id = Request::input('wpp_id');

    
    if(Request::input('telefone') <> null){
      $telefone->save();
    }   
    //return Request::all();
    return redirect('/cliente/view/'.$telefone->cliente_id);
  }

  public function salvaEmail(){

    $email = email::find(Request::input('id'));
    $email->email = Request::input('email');
    $email->status_id = Request::input('status_id');

    
    if(Request::input('email') <> null){
      $email->save();
    }   
    //return Request::all();
    return redirect('/cliente/view/'.$email->cliente_id);
  }

  public function upload(){
    return view('/cliente/file');
  }

  public function file(request $request){
      $row = 1;
      $handle = fopen($request::file('file'), "r");
      while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        if ($row > 1) {        
          var_dump($data[0]);
          $cliente = new cliente;
          $cliente->nome = $data[1];
          $cliente->CPF = $data[0];
          $cliente->create();
          echo "<br>";
        }
      }

      fclose($handle);
      //return $data;

    
  }
}
