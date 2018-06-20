@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel panel-heading text-center">
                    Pesquisa Cliente
                </div>
                <div class="panel-body">
                    <form method="post" action="{{url('cliente/search')}}" >
                        <input value="{{csrf_token()}}" name="_token" type="hidden">
                        
                                                    
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Busca Por CPF:</label>
                                        <input class="form-control" type="text" name="CPF" id="CPF">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="name">Busca Por Nome</label>
                                        <input class="form-control" type="text" name="name" id="name">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="name">Busca Por Telefone</label>
                                        <input class="form-control" type="number" name="tel" id="tel">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success btn-block text-center">
                                        Pesquisar
                                    </button>
                                </div>
                            </div>
                            
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@extends('layouts.footer')