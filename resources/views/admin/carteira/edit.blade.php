@extends('layouts/app')

@section('content')

    <div class="col-md-12">
        <form method="post" action="{{URL('admin/carteira/salvarEdit')}}">
            <input value="{{csrf_token()}}" name="_token" type="hidden">
            <input value="{!!$carteira->id!!}" name="id" type="hidden">
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" value="{!!$carteira->nome!!}" placeholder="Nome">
                    </div>
                </div>

                <div class="col-md-2 col-md-offset-7">
                    <div class="form-group pull-right">
                        <a href="{{URL('admin/situacao/edit/'.$carteira->id)}}" class="btn btn-info btn-lg btn-block">SITUAÇÕES</a>
                    </div>

                      <div class="form-group pull-right">
                        <a href="{{URL('admin/marketplace/edit/'.$carteira->id)}}" class="btn btn-info btn-lg btn-block">MARKETPLACES</a>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-block" >SALVAR</button>
            
        </form>
        
    </div>
@stop
@extends('layouts.footer')