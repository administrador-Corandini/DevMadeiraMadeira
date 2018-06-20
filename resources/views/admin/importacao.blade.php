@extends('layouts/app')

@section('content')
	
	<h4 class="text-center">Importação de Arquivo</h4>
	<div class="col-md-6 col-md-offset-3">
		<form method="post" action="{{url('admin/SalvaImportacao')}}" enctype="multipart/form-data">
			<input value="{{csrf_token()}}" name="_token" type="hidden">
			<div class="form-group">
				<label for="file">Arquivo:</label>
				<input type="file" name="file" id="file">
			</div>
			<div class="form-group">
				<label for="Carteira">Carteira</label>
				<select name="carteira" id="carteira" class="form-control">
					<option value="0" disabled selected> Selecione a carteira</option>

					@foreach($carteiras as $carteira)
						<option value="{!!$carteira->id!!}">{!!$carteira->nome!!}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<button class="btn btn-success" type="submit">IMPORTAR</button></button>
			</div>		
		</form>
	</div>


@stop
@extends('layouts.footer')