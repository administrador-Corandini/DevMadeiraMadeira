@extends('layouts/app')

@section('content')
    
    <div class="col-md-12">
        
                <div class="alert alert-info text-center">
                    SITUAÇÕES DA CARTEIRA - {!!strtoupper($carteira->nome)!!}
                </div>
                <table class="table table-condesed table-bordered">
                    <thead>
                        <th>ID</th>
                        <th>SITUAÇÃO | PRIORIDADE | CANAL</th>
                    </thead>
                    <tbody>
                        @foreach($situacoes as $situacao)
                            
                            <tr>
                                
                                    <td>{{$situacao->id}}</td>
                                    <td>
                                        <form method="post" action="{{url('admin/situacao/salvarEdit')}}" >
                                            <input value="{{csrf_token()}}" name="_token" type="hidden">
                                            <input value="{!!$situacao->id!!}" name="id" type="hidden">
                                            
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Situação" value="{!!$situacao->nome!!}">
                                            </div>

                                            <div class="col-md-1">
                                                <input type="text" class="form-control" id="prioridade" name="prioridade" placeholder="Prioridade" value="{!! $situacao->prioridade !!}">
                                            </div>

                                            <div class="col-md-1">
                                                <input type="text" class="form-control" id="canal" name="canal" placeholder="canal" value="{!! $situacao->canal !!}">
                                            </div>

                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-success btn-block" >SALVAR</button>
                                            </div>
                                                                                        
                                        </form>
                                    </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>

                                
                                  
                
            
        
    </div>
@stop
@extends('layouts.footer')