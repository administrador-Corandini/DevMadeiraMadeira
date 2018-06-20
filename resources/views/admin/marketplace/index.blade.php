@extends('layouts/app')

@section('content')

    <div class="col-md-12">
        <table class="table table-bordered table-condensed">
            <thead>
                <th>ID</th>
                <th>Marketplace</th>
                <th>Edit</th>
                <th>Apagar</th>
            </thead>
            <tbody>
              
                @foreach($marketplaces as $marketplace)
                    <tr>
                        <td>{!!$marketplace->id!!}</td>
                        <td>{!!$marketplace->nome!!}</td>
                        <td><a class="btn btn-primary btn-block" href="{{URL('admin/marketplace/'.$marketplace->id.'/edit')}}">EDITAR</a></td>
                        <td><a class="btn btn-danger btn-block" href="">APAGAR</a></td>                   
                    </tr>
                    
                @endforeach
      
            </tbody>
        </table>
        <a class="btn btn-success btn-block" href="">NOVO MARKETPLACE</a>
    </div>
@stop
@extends('layouts.footer')