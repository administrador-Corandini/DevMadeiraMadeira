@extends('layouts/app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<form method="post" enctype="multipart/form-data" action="{{url('cliente/file')}}">
			<input value="{{csrf_token()}}" name="_token" type="hidden">
			<div class="form-group">
				<label>Upload de arquivo</label>
				<input type="file" name="file">
			</div>
			
			<div class="form-group">
				<input type="submit" value="Upload" class="btn btn-success">
			</div>
		</form>
	</div>
</div>

@stop

@extends('layouts.footer')