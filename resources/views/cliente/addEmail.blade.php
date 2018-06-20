@extends('layouts/app')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">Adicionar Email</h3>
				</div>
				<div class="panel-body">
					<form method="post" action="{{url('cliente/salvaAddEmail')}}" >
						<input value="{{csrf_token()}}" name="_token" type="hidden">
						<input value="{{$cliente_id}}" name="cliente_id" type="hidden">
						<div class="form-group">
							<label>Email:</label>
							<input class="form-control" type="email" name="email">
						</div>
						<div class="form-group">
							<label>Status Email:</label>
							<select class="form-control" name='status_id'>
								@foreach($status as $s)
									<option value="{{$s->id}}">{!!$s->status!!}</option>
								@endforeach						
							</select>
						</div>

						<div class="form-group">
							<button class="btn btn-success btn-block">
								Adicionar Email
							</button>
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</div>	
@stop

@extends('layouts.footer')