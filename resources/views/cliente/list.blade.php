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
					<th>Situação</th>
					<th>Carteira</th>
					<th>Visualizar</th>
				</thead>
				<tbody>
					@foreach($fichas as $f)
						<tr>
							<td> {{$f->id}}</td>
							<td>{!!$f->nome!!}</td>
							<td>{{$f->CPF}}</td>
							<td>{!!$f->situacao->nome!!}</td>
							@if(isset($f->produto[0]))
								<td>{!!$f->produto[0]->carteira->nome!!}</td>
							@else
								<td>NÃO ENCONTRADO</td>
							@endif
							<td>
								<a href="{{url("/cliente/view")}}/{{$f->id}}">Visualizar</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			{!! $fichas !!}
		</div>
	
	</div>
</div>


@stop

@extends('layouts.footer')