@extends('layouts/app')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">Criando um novo Usuario</h3>
				</div>
				<div class="panel-body">
					
					<form method="post" action="{{url('admin/user')}}">
						<input value="{{csrf_token()}}" name="_token" type="hidden">

						<div class="form-group">
							<input type="text" id="name" name="name" placeholder="Nome" class="form-control">
						</div>

						<div class="form-group">
							<input type="email" id="email" name="email" placeholder="email" class="form-control">
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