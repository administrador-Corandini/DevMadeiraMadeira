@extends('layouts/app')

@section('content')
<div class="row">
	<div class="col-md-12">

		
		<div class="table-responsive">
			<table class="tabel table-striped table-bordered table-hover table-condensed">
				<thead>
					<th>ID</th>
					<th>Nome</th>
					<th class="text-center">CPF</th>
					<th>Visualizar</th>
				</thead>
				<tbody>
					@foreach($cliente as $f)
						<tr>
							<td> {{$f->id}}</td>
							<td>{!!strtoupper($f->nome)!!}</td>
							<td>{{$f->CPF}}</td>
							<td>
								<a href="{{url("/cliente/view")}}/{{$f->id}}">Visualizar</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			{!! $cliente !!}
		</div>
	
	</div>
</div>

@stop

@extends('layouts.footer')