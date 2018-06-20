@extends('layouts/app')

@section('content')
    
    <div class="col-md-12">
        
                <div class="alert alert-info text-center">
                    MARKEPLACE DA CARTEIRA - {!!strtoupper($carteira->nome)!!}
                </div>
                
                    @foreach($marketplaces as $marketplace)
                        <div class="row">
                            <form method="post" class="form-inline" action="{{url('admin/marketplace/salvarEdit')}}" >
                                <input value="{{csrf_token()}}" name="_token" type="hidden">
                                <input value="{!!$marketplace->id!!}" name="id" type="hidden">
                                
                                <div class="form-group">
                                    <label for="nome" class="control-label">NOME:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Marketplace" value="{!!$marketplace->nome!!}">
                                </div>
                                <div class="form-group">
                                    <label for="link" class="control-label">LINK:</label>
                                    <input type="text" class="form-control" id="link" name="link" placeholder="Link" value="{!!$marketplace->link!!}">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block" >SALVAR</button>
                                </div>
                            </form>
                        </div>
                                                                                    
                                    
                        
                    @endforeach
        
    </div>
@stop
@extends('layouts.footer')