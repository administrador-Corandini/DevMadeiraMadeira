@extends('layouts/app')

@section('content')

	

	<form method="POST" action="">
		<div class="row">

			<div class="col-md-3">
				<div class="form-group">
					<label>Nome:</label>
					<input class="form-control" type="text" name="name">
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label>CPF:</label>
					<input class="form-control" type="text" name='cpf'>
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>Telefone Celular:</label>
					<input class="form-control" type="text" name='celular'>
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>Telefone Residencial:</label>
					<input class="form-control" type="text" name='RESIDENCIAL'>
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>ID Marketplace:</label>
					<input class="form-control" type="text" name="id_pedido_marketplace">
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>ID Entrega Marketplace:</label>
					<input class="form-control" type="text" name="entrega_marketplace">
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>ID Pedido Madeira Madeira:</label>
					<input class="form-control" type="text" name="id_produto_mm">
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>ID Produto:</label>
					<input class="form-control" type="text" name="id_produto">
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>Data entregue Produto:</label>
					<input class="form-control" type="date" name="data_entregue_produto">
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>Prazo Prometido Produto:</label>
					<input class="form-control" type="date" name="prazo_prometido_produto">
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>Data entregue Pedido:</label>
					<input class="form-control" type="date" name="data_entregue_pedido">
				</div>
			</div>

			<div class="col-md-2">
				<div class="form-group">
					<label>Prometido Produto:</label>
					<input class="form-control" type="date" name="data_prometido_pedido">
				</div>
			</div>

			<div class="col-md-8">
				<div class="form-group">
					<label>Produto:</label>
					<input class='form-control' type="text" name="produto">
				</div>
			</div>

		</div><!--row-->


		<div class="row">
			<div class="col-md-12 col-md-offset-0">
				<button class="btn btn-success btn-block">SALVAR</button>	
			</div>
		</div>

	</form>

@stop

@extends('layouts.footer')