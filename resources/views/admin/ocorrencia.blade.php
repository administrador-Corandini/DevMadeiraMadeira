@extends('layouts/app')

@section('content')
	<div class="row">
		<div class="col-md-2">
			<div class="form-group">
				<label>Data Ocorrencia Inicial</label>
				<input class="form-control" type="date" />
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
				<label>Data Ocorrencia Final</label>
				<input class="form-control" type="date" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<table class="table table-striped table-bordered table-hover table-condensed">
				<thead>
					<th>Agente</th>
					<th>Quantidade</th>
					<th>% Participação</th>
				</thead>
				<tbody>
					@foreach($quantiOcorrencia as $qOco)
						<tr>
							<td>{{$qOco->USER}}</td>
							<td>{{$qOco->quant}}</td>
							<td>{{number_format((($qOco->quant/$totalOcorrencia)*100),2)}} %</td>
						</tr>
					@endforeach
					<tfoot>
						<tr class="success">
							<td>Total</td>
							<td>{{$totalOcorrencia}}</td>
							<td>100.00%</td>
						</tr>
					</tfoot>
				</tbody>
			</table>
		</div>

		<div class="col-md-4">
			<table class="table table-striped table-bordered table-hover table-condensed">
				<thead>
					<th>Situação</th>
					<th>Quantidade</th>
					<th>% Participação</th>
				</thead>
				<tbody>
					@foreach($quantiOcorrenciaSituacao as $qOcoSit)
						<tr>
							<td>{{$qOcoSit->situacao}}</td>
							<td>{{$qOcoSit->quant}}</td>
							<td>{{number_format((($qOcoSit->quant/$totalOcorrencia)*100),2)}} %</td>
						</tr>
					@endforeach
					<tfoot>
						<tr class="success">
							<td>Total</td>
							<td>{{$totalOcorrencia}}</td>
							<td>100.00%</td>
						</tr>
					</tfoot>
				</tbody>
			</table>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered table-hover table-condensed">
				<thead>
					<th>ID CLIENTE</th>
					<th>CPF</th>
					<th>NOME</th>
					<th>ID PEDIDO MARKETPLACE</th>
					<th>TELEFONE</th>
					<th>EMAIL</th>
					<th>SITUAÇÃO</th>
					<th>DATA OCORRENCIA</th>
					<th>OCORRENCIA</th>
				</thead>
				<tbody>
					@if($ocorrencia <> null)
					@foreach($ocorrencia as $oco)
						<tr>
							<td>{{$oco->id}}</td>
							<td>{{$oco->CPF}}</td>
							<td>{{$oco->nomeCliente}}</td>
							<td>{{$oco->id_pedido_marketplace}}</td>
							<td>{{$oco->tel}}</td>
							<td>{{$oco->mail}}</td>
							<td>{{$oco->situacao}}</td>
							<td>{{$oco->created_at}}</td>
							<td>{{$oco->ocorrencia}}</td>
						</tr>
					@endforeach
					@endif
					<tr>
						
					</tr>
				</tbody>
			</table>
			<!--{$ocorrencia->ocorrencia() }}-->
		</div>
	</div>
@stop
@extends('layouts.footer')