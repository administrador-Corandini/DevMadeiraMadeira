@extends('layouts/app')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">Criar um novo canal</h3>
				</div>
				<div class="panel-body">
					
					
					
					<form method="post" action="{{url('cliente/canal')}}">
						<input value="{{csrf_token()}}" name="_token" type="hidden">	
						<div class="form-group">
							<input type="text" id="nome" name="nome" placeholder="Nome" class="form-control">
						</div>
						
						<div class="form-group">
							<button class="btn btn-success btn-block">
								SALVAR
							</button>
						</div>
					
					</form>


				</div>
			</div>
			
		</div>
	</div>	
@stop

@extends('layouts.footer')