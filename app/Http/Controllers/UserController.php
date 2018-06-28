<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Http\Request;
use Request;
use App\User;

class UserController extends Controller
{
    
    public function index()
    {
        $user = user::all();
        return view('users.index')->with('user', $user);
    }

    
    public function create()
    {
        return view('users.create');
    }

   
    public function store(Request $request)
    {
        $rules = array(
            'name'  => 'required|min:3|max:25',
            'email' => 'required|min:3|max:35'
        );

        $messages = array(
            'name.required'     => 'É necessario incluir o nome',
            'name.min'          => 'É necessario um nome com ao menos 3 caracteres',
            'name.max'          => 'o tamanho maximo do nome é 25',
            'email.required'    => 'É necessario incluir o email',
            'email.min'         => 'O Email Informado é muito curto',
            'email.max'         => 'O Email informado é muito longo'
        );

        $validator = Validator::make(Request::all(), $rules,$messages);

        if ($validator->fails()) {
            return Redirect('admin/user/create')
                ->withErrors($validator);
          } else {
            $user = new User;
            $user->create($request::all());
            return Redirect('admin/user');
            
          }

    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $user = user::find($id);
        return view('users.edit')->with('user',$user);
    }

   
    public function update(Request $request, $id)
    {

        return $id;
        $rules = array(
            'name'      => 'required|min:3|max:25',
            'email'     => 'required|min:3|max:35',
            'password'  => 'required'
        );

        $messages = array(
            'name.required'     => 'É necessario incluir o nome',
            'name.min'          => 'É necessario um nome com ao menos 3 caracteres',
            'name.max'          => 'o tamanho maximo do nome é 25',
            'email.required'    => 'É necessario incluir o email',
            'email.min'         => 'O Email Informado é muito curto',
            'email.max'         => 'O Email informado é muito longo',
            'password.required' => 'É necessario inserir o password'
        );

        $validator = Validator::make(Request::all(), $rules,$messages);

        if ($validator->fails()) {
            return Redirect('admin/user/'.$id.'/edit')
                ->withErrors($validator);
          } else {
            $user = User::find($id);
            $user->name     = $request->input('name');
            $user->email    = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return Redirect('admin/user');
            
          }
    }

    
    public function destroy($id)
    {
        //
    }
}
