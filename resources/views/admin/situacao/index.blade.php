@extends('layouts/app')

@section('content')

    <div class="col-md-12">
        <table class="table table-bordered table-condensed">
            <thead>
                <th>ID</th>
                <th>Situação</th>
                <th>Edit</th>
                <th>Apagar</th>
            </thead>
            <tbody>
              
                @foreach($situacoes as $situacao)
                    <tr>
                        <td>{!!$situacao->id!!}</td>
                        <td>{!!$situacao->nome!!}</td>
                        <td><a class="btn btn-primary btn-block" href="{{URL('admin/situacao/'.$situacao->id.'/edit')}}">EDITAR</a></td>
                        <td><a class="btn btn-danger btn-block" href="">APAGAR</a></td>                   
                    </tr>
                    
                @endforeach
      
            </tbody>
        </table>
        <a class="btn btn-success btn-block" href="">NOVA SITUAÇÃO</a>
    </div>
@stop
@extends('layouts.footer')