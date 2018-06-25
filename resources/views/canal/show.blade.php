@extends('layouts/app')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">Escolha o Canal de Contato do cliente</h3>
				</div>
				<div class="panel-body">
					<form method="post" action="{{url('cliente/canal')}}" >
						<input value="{{csrf_token()}}" name="_token" type="hidden">
						<div class="form-group">
							<label>Canal:</label>
							<select class="form-control" name='status_id'>
								@foreach($canal as $c)
									<option value="{{$c->id}}">{!!$c->nome!!}</option>
								@endforeach						
							</select>
						</div>

						<div class="form-group">
							<button class="btn btn-success btn-block">
								Salvar
							</button>
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</div>	
@stop

@extends('layouts.footer')