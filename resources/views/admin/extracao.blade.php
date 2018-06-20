@extends('layouts/app')

@section('content')
	
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-primary">
				<div class="panel-heading">Situações</div>
				<div class="panel-body">
					@foreach($situacoes as $s)
						<div class="form-group">
							<label for="{{ $s->id }}">{{ $s->nome}}</label>
							<input type="checkbox" name="{{ $s->id }}">
						</div>
					@endforeach
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="panel panel-primary">
				<div class="panel-heading">Status Telefones</div>
				<div class="panel-body">
					@foreach($statusTelefone as $s)
						<div class="form-group">
							<label for="{{ $s->id }}">{{ $s->status}}</label>
							<input type="checkbox" name="{{ $s->id }}">
						</div>
					@endforeach
				</div>
			</div>
		</div>

		<div class="col-md-3">

			<div class="row">

			
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">Carteiras</div>
						<div class="panel-body">
							
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">Tipos de Telefones</div>
						<div class="panel-body">
							
						</div>
					</div>
				</div>

			</div>
			


		</div>
	</div>

@stop
@extends('layouts.footer')