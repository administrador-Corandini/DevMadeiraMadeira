@extends('layouts/app')

@section('content')

    <div class="col-md-12">
        <table class="table table-bordered table-condensed">
            <thead>
                <th>ID</th>
                <th>Carteira</th>
                <th>Edit</th>
                <th>Apagar</th>
            </thead>
            <tbody>
              
                @foreach($carteiras as $carteira)
                    <tr>
                        <td>{!!$carteira->id!!}</td>
                        <td>{!!$carteira->nome!!}</td>
                        <td><a class="btn btn-primary btn-block" href="{{URL('admin/carteira/'.$carteira->id.'/edit')}}">EDITAR</a></td>
                        <td><a class="btn btn-danger btn-block" href="">APAGAR</a></td>                   
                    </tr>
                    
                @endforeach
      
            </tbody>
        </table>
        <a class="btn btn-success btn-block" href="">NOVA CARTEIRA</a>
    </div>
@stop
@extends('layouts.footer')