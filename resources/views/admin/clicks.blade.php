@extends('layouts/app')

@section('content')
	<div class="row">
		@foreach($links_abertos as $la)
			@if($la->tipo_envio_id == 1)
				<div class="col-md-3">
					<div class="panel panel-danger">
						<div class="panel-heading">
							<div class="text-center">
								Email
								<i class="fas fa-at"></i>
							</div>
						</div>
						<div class="panel-body text-center">

							
								<h3>Links Enviados <span class="badge">{{$la->enviados}}</span></h3>
							
								<h3>Clicks <span class="badge"> {{$la->abertos}} </span> </h3> 
							
								<h3>Taxa de Conversão <span class="badge">{{number_format((100* ($la->abertos/$la->enviados)),2)}} %</span></h3>
							
						</div>
					</div>
				</div>
			@elseif($la->tipo_envio_id == 2)
				<div class="col-md-3">
					<div class="panel panel-success">
						<div class="panel-heading">
							<div class="text-center">
								Whatsapp
								<i class="fab fa-whatsapp"></i>
							</div>
						</div>
						<div class="panel-body text-center">
							
								<h3>Links Enviados <span class="badge">{{$la->enviados}}</span></h3>
							
								<h3>Clicks <span class="badge"> {{$la->abertos}} </span> </h3> 

								<h3>Taxa de Conversão <span class="badge">{{number_format((100* ($la->abertos/$la->enviados)),2)}} %</span></h3>
							
						</div>
					</div>
				</div>
				
				
			@else
				<div class="col-md-3">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="text-center">
								SMS
								<i class="far fa-comment"></i>
							</div>
						</div>
						<div class="panel-body text-center">
							
								<h3>Links Enviados <span class="badge">{{$la->enviados}}</span></h3>
							
								<h3>Clicks <span class="badge"> {{$la->abertos}} </span> </h3> 

								<h3>Taxa de Conversão <span class="badge">{{ number_format((100* ($la->abertos/$la->enviados)),2)}} %</span></h3>
							
						</div>
					</div>
				</div>
			@endif
		@endforeach
			
			<div class="col-md-3">
					<div class="panel panel-warning">
						<div class="panel-heading">
							<div class="text-center">
								TOTAL
								
							</div>
						</div>
						<div class="panel-body text-center">

							
								<h3>Links Enviados <span class="badge">{{$total[0]->quanti}}</span></h3>
							
								<h3>Clicks <span class="badge"> {{$total[1]->quanti}} </span> </h3> 

								<h3>Taxa de Conversão <span class="badge">{{number_format((100* ($total[1]->quanti/$total[0]->quanti)),2)}} %</span></h3>
							
							
							
						</div>
					</div>
				</div>
		</div>
		
	
	<div class="row">
		<form method="POST" action="{{'AdminController@clicks'}}">
			<div class="col-md-2">
				<div class="form-group">
					<label>Data Inicio</label>
					<input class="form-control" type="date"/>
				</div>			
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>Data Final</label>
					<input class="form-control" type="date"/>
				</div>			
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>Filtrar Links (Abertos/Não Abertos)</label>
					<select class="form-control">
						<option selected>Todos</option>
						<option>Abertos</option>
						<option>Não Abertos</option>
					</select>
				</div>			
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>Tipo de Envio</label><br>
					<label class="checkbox-inline"><input type="checkbox" value="">Email</label>
					<label class="checkbox-inline"><input type="checkbox" value="">Whatsapp</label>
					<label class="checkbox-inline"><input type="checkbox" value="">SMS</label>
					
				</div>			
			</div>
		</form>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<th>ID</th>
						<th>Link</th>
						<th>Cliente</th>
						<th>Tipo Envio</th>
						<th>Destino</th>
						<th>ID Produto</th>
						<th>Link Aberto</th>
						<th>Data Hora Envio</th>
						<th>Data Hora Abertura Link</th>
					</thead>
					<tbody>
						@foreach($links as $l)
							<tr>
								<td>{{$l->id}}</td>
								<td>{{$l->link_random}}</td>
								<td>
									<a href="{{url('cliente/view')}}/{{$l->cliente_id}}">
										{{$l->cliente_id}}
									</a>
								</td>
								<td>{{$l->tipoEnvio->tipo}}</td>
								<td>{{$l->destino}}</td>
								<td>{{$l->id_produto}}</td>
								<td>{{$l->open}}</td>
								<td>{{$l->created_at}}</td>
								<td>{{$l->updated_at}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{{ $links->links() }}
			</div>
		</div>
	</div>
@stop
@extends('layouts.footer')