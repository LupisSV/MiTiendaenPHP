@extends('layout')

@section('content')
<div class="row justify-content-center">
<div class="col-md-5">
	<form action="{{route('productos.store')}}" method="post">
		@if (session()->has('status'))
			<div class="alert alert-success">
				{{session('status')}}
			</div>
			
		@endif
		<h2>Crear nuevo producto</h2>
		<div class="form-group">
			<input type="text" name="nombre" class="form-control" placeholder="Nombre de producto" value="{{old('nombre')}}">
		</div>
		<br>
		<div class="form-group">
			<input type="text" name="descripcion" class="form-control" placeholder="Descripcion del producto" value="{{old('descripcion')}}">
		</div><br>
		<div class="form-group">
			<input type="number" name="precio" class="form-control" placeholder="Precio del producto" value="{{old('precio')}}">
		</div>
		<br>
		<div class="form-group">
			<center><input type="submit" value="Crear" class="btn btn-primary"></center>	
		</div>
		{{ csrf_field() }}
	</form>
</div>
</div>
@endsection