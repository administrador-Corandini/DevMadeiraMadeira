@extends('layouts/app')

@section('content')
<div class="row">
	<div class="col-md-12">

		
		<div class="table-responsive">
			<table class="tabel table-striped table-bordered table-hover table-condensed">
				<thead>
					<th>Data e Hora</th>
					<th>Cliente</th>

				</thead>
				<tbody>
				{{$agendaHora}}
					@foreach($agendaHora as $a)
						<tr>
							<td> {{$a->data}}</td>
							<td>
								<a href="{{url("/cliente/view")}}/{{$a->cliente->id}}">{{$a->cliente->nome}}
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			{{ $agendaHora }}
		</div>
	
	</div>
</div>

@stop

@extends('layouts.footer')