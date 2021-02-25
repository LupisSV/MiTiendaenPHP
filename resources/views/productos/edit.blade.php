@extends ('layout')

@section('content')
	<div class="row justify-content-center">
<div class="col-md-5">
	<form action="{{route('productos.update', $producto->id)}}" method="post">
		@if (session()->has('status'))
			<div class="alert alert-success">
				{{session('status')}}
			</div>
			
		@endif
		<h2>Editar producto {{ $producto->nombre}}</h2>
		<div class="form-group">
			<input type="text" name="nombre" class="form-control" placeholder="Nombre de producto" value="{{old('nombre') ?? $producto->nombre}}">
		</div>
		<br>
		<div class="form-group">
			<input type="text" name="descripcion" class="form-control" placeholder="Descripcion del producto" value="{{old('descripcion') ?? $producto->descripcion}}">
		</div><br>
		<div class="form-group">
			<input type="number" name="precio" class="form-control" placeholder="Precio del producto" value="{{old('precio') ?? $producto->precio}}">
		</div>
		<br>
		<div class="form-group">
			<center><input type="submit" value="Editar" class="btn btn-primary"></center>	
		</div>
		{{ csrf_field() }}
		{{ method_field('PUT')}}
	</form>
</div>
</div>
@endsection