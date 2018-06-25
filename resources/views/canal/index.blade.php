@extends('layouts/app')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">Canais</h3>
				</div>
				<br>
					<a href="{{URL::to('cliente/canal/create')}}" class="btn btn-success">
						Criar Um Novo Canal
					</a>
				<div class="panel-body">
					<table class="table table-bordered">
						<thead>
							<th>ID</th>
							<th>CANAL</th>
							<th>AÇÃO</th>
						</thead>
						<tbody>
							@foreach($canal as $c)
								<tr>
									<td>{{$c->id}}</td>
									<td>{{$c->nome}}</td>
									<td>
										<a class="btn btn-info" href="{{ URL::to('cliente/canal/' . $c->id . '/edit') }}">EDITAR</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					
					</table>
				</div>
			</div>
			
		</div>
	</div>	
@stop

@extends('layouts.footer')