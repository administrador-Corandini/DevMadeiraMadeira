@extends('layouts/app')

@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">

		@if(!$agendaHora->isEmpty())
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover table-condensed">
				<thead>
					<th>Data e Hora para Retorno</th>
					<th>Cliente</th>
					<th>Agente Que Agendou</th>

				</thead>
				<tbody>
					@foreach($agendaHora as $a)
						<tr>
							<td> {{ date("d/m/Y h:i:s",strtotime($a->data))}}</td>
							<td>
								<a href="{{url("/cliente/view")}}/{{$a->cliente->id}}">{{$a->cliente->nome}}
								</a>
							</td>
							<td>
								{{$a->user->name}}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			{{ $agendaHora }}
		</div>
		@else
			<div class="col-md-8 col-md-offset-2">
				<div class="alert alert-info text-center">
					<strong>
						Opa Que Beleza, a Agenda da Equipe esta em dia
					</strong>
				</div>
			</div>
		@endif
	
	</div>
</div>

@stop

@extends('layouts.footer')