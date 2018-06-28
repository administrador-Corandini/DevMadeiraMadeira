@extends('layouts/app')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">Usuarios</h3>
				</div>
				<br>
					<a href="{{URL::to('admin/user/create')}}" class="btn btn-success">
						Criar Um Novo Ususario	
					</a>
				<div class="panel-body">
					<table class="table table-bordered">
						<thead>
							<th>ID</th>
							<th>Nome</th>
							<th>Email</th>
							<th>Ações</th>
						</thead>
						<tbody>
							@foreach($user as $u)
								<tr>
									<td>{{$u->id}}</td>
									<td>{{$u->name}}</td>
									<td>{{$u->email}}</td>
									<td>
										<a class="btn btn-info" href="{{ URL::to('admin/user/' . $u->id . '/edit') }}">EDITAR</a>
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