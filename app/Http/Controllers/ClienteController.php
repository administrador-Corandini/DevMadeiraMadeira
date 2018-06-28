<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
usE App\canal;

class ClienteController extends Controller
{
  public function show($id){
    $canal = canal::all();
    $agendaHora = agendahora::where('data','<=',date('Y-m-d H:i:s'))->where('ativo',0)->orderBy('data')->get();
   	$cliente = Cliente::findOrFail($id);
    $ocorrencia = ocorrencia::where('cliente_id', $id)->orderBy('created_at','DESC')->paginate(3);
    $status = statu::all();
    $situacao = situacao::where('carteira_id',$cliente->carteira_id)->get();
    $wpp = wpp::all();
     //return view('cliente/show',['cliente' => $cliente,'status' => $status,'ocorrencia' => $ocorrencia, 'situacao' => $situacao , 'wpp' => $wpp]);
     return view('cliente/show')->with('cliente', $cliente)->with('status', $status)->with('ocorrencia', $ocorrencia)->with('situacao' , $situacao)->with('wpp' , $wpp)->with('agendaHora',$agendaHora)->with('canal',$canal);
  }

  public function create(){
    return view('cliente/create');
  }

  public function search(){
    $cpf   = Request::input('CPF');
    $name  = Request::input('name');
    $tel = Request::input('tel');

    if( $cpf <> "" )
      $cliente = cliente::where('cpf','like','%'.$cpf.'%')->paginate(30);
    

    if( $name <> "" )
      $cliente = cliente::where('nome','like','%'.$name.'%')->paginate(30);

    if( $tel <> "" ){
      $cliente = new cliente;
      $cliente = DB::select("select clientes.* from clientes inner join telefones on telefones.cliente_id = clientes.id where telefone like ?",['%'.$tel.'%']);
    }

    if($cpf == "" AND $name == "" AND $tel == "" ){
      return redirect('home');
    }

    $agendaHora = agendahora::where('data','<=',date('Y-m-d H:i:s'))->where('ativo',0)->orderBy('data')->get();

    return view('cliente/search')->with('cliente', $cliente)->with('agendaHora',$agendaHora);

  }

   public function list(){
    $agendaHora = agendahora::where('data','<=',date('Y-m-d H:i:s'))->where('ativo',0)->orderBy('data')->get();
    $situacao = situacao::where('prioridade','>','0')->orderBy('prioridade')->get();
    $situacoes = array();
    
    foreach($situacao as $s){
      $situacoes[] = $s->id;
    }

    $agendaHora = agendahora::where('data','<=',date('Y-m-d H:i:s'))->where('ativo',1)->orderBy('data')->get();
    $fichas = Cliente::whereIn('situacao_id',[$situacoes])->paginate(30);
    return view('cliente/list')->with('fichas', $fichas)->with('agendaHora',$agendaHora);

   }

  public function addTelefone($id){

    $status = statu::all();
    return view('cliente/addTelefone',array('id' => $id,'status' => $status, 'cliente_id' => $id,'agendaHora' => $agendaHora));
  }

  public function salvaAddTelefone(){
    
    $telefone   = Request::input('telefone');
    $status_id  = Request::input('status_id');
    $cliente_id = Request::input('cliente_id');

    $rules = array(
      'telefone'      => 'required|min:10|max:12',
      'status_id'     => 'required',
      'cliente_id'    => 'required'
    );
    
    $messages = [
        'telefone.required' => "É necessario que preencher o telefone",
        'telefone.min'      => "Esse numero é muito curto",
        'telefone.max'      => "Esse numero é muito Longo",
        'status_id'         => "É necessario que informar o status"
    ];

    $validator = Validator::make(Request::all(), $rules,$messages);

    if ($validator->fails()) {
      return Redirect('cliente/addTelefone/'.$cliente_id)
          ->withErrors($validator);
    } else {
      DB::insert('INSERT INTO telefones (cliente_id,telefone,status_id) VALUES (?,?,?)',array($cliente_id,$telefone,$status_id));
      return redirect('/cliente/view/'.$cliente_id);
    }

    
  }

  public function addEmail($id){
    $status = statu::all();
    return view('cliente/addEmail',array('id' => $id,'status' => $status, 'cliente_id' => $id));
  }

  public function salvaAddEmail(){

    $email   = Request::input('email');
    $status_id  = Request::input('status_id');
    $cliente_id = Request::input('cliente_id');

    $rules = array(
      'email'      => 'required|min:6|max:25',
      'status_id'     => 'required',
      'cliente_id'    => 'required'
    );
    
    $messages = [
        'email.required' => "É necessario que preencher o email",
        'email.min'      => "Esse email é muito curto",
        'email.max'      => "Esse email é muito Longo",
        'status_id'      => "É necessario que informar o status"
    ];

    $validator = Validator::make(Request::all(), $rules,$messages);

    if ($validator->fails()) {
      return Redirect('cliente/addEmail/'.$cliente_id)
          ->withErrors($validator);
    } else {
      DB::insert('INSERT INTO emails (cliente_id,email,status_id) VALUES (?,?,?)',array($cliente_id,$email,$status_id));
      return redirect('/cliente/view/'.$cliente_id);
    }
      
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

    $ocorrencia               = new ocorrencia;
    $ocorrencia->cliente_id   = Request::input('cliente_id');
    $ocorrencia->ocorrencia   = Request::input('ocorrencia');
    $ocorrencia->situacao_id  = Request::input('situacao');
    $ocorrencia->user_id      = Request::input('user');
    
    $situacao = situacao::find(Request::input('situacao'));
    if($situacao->canal == 1){
      $ocorrencia->canal_id     = Request::input('canal');
      $rules = array(
        'ocorrencia'  => 'required',
        'canal' => 'integer|min:2'
      );
        
    }else{
      $rules = array(
        'ocorrencia'  => 'required'
      );
    }

    $cliente                  = cliente::find(Request::input('cliente_id'));
    $cliente->situacao_id     = Request::input('situacao');

    $messages = [
      'ocorrencia.required' => "Opa é necessario preencher a ocorrencia",
      'canal.min' => "Por favor Informe o canal"
    ];

    $validator = Validator::make(Request::all(), $rules,$messages);

 
    if ($validator->fails()) {
        return redirect('/cliente/view/'.$cliente->id)
            ->withErrors($validator);
    } else {



      if($ocorrencia <> null){
        $cliente->save();
        $ocorrencia->save();
      }else{
        $errors->nome = 'É necessario colocar ocorrencia';
      }


      if($cliente->situacao->canal == 1){
        return redirect('/cliente/view/'.$cliente->id);
      }else{
        return redirect('/cliente/view/'.$cliente->id);
      }
    }
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
  }

  public function devolucao($id){
    $cliente = new cliente;
    $cliente->inativa($id);
    return;
  }
}
