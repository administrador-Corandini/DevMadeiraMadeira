@extends('layouts/app')

@section('content')
	
	<div class="row">
		<div class="col-md-2 col-md-offset-1">
			<a href="{{url('admin/clicks')}}" class="thumbnail">
				<div class="text-center">
					MONITOR DE CLICKS
				</div>
			</a>
		</div>

		<div class="col-md-2">
			<a href="{{url('admin/ocorrencia')}}" class="thumbnail">
				<div class="text-center">
					OCORRENCIAS 
				</div>
			</a>
		</div>

		<div class="col-md-2">
			<a href="{{url('admin/extracao')}}" class="thumbnail">
				<div class="text-center">
					EXTRAÇÃO DE MALLING
				</div>
			</a>
		</div>

		<div class="col-md-2">
			<a href="{{url('admin/importacao')}}" class="thumbnail">
				<div class="text-center">
					IMPORTAÇÃO DE CLIENTES 
				</div>
			</a>
		</div>

		<div class="col-md-2">
			<a href="{{url('admin/carteira')}}" class="thumbnail">
				<div class="text-center">
					CARTEIRAS 
				</div>
			</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-2 col-md-offset-1">
			<a href="{{url('admin/monitor')}}" class="thumbnail">
				<div class="text-center">
					ANALISE CARTEIRAS 
				</div>
			</a>
		</div>

@stop
@extends('layouts.footer')