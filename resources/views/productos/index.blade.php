@extends('layout')
	@section('content')

	@if (session()->has('status'))
			<div class="alert alert-success">
				{{session('status')}}
			</div>
	@endif
		<br>
		<center>
			<a href="{{route('productos.create')}}" class="btn btn-primary">Agregar nuevo producto</a>
		</center>
		<br>
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">Nombre</th>
			      <th scope="col">Descripcion</th>
			      <th scope="col">Precio</th>
			      <th scope="col">Acciones</th>
			  
			    </tr>
			  </thead>
			  
			  <tbody>
			  	@foreach ($productos as $producto)
			    <tr>
			      <td>{{$producto->nombre}}</th>
			      <td>{{$producto->descripcion}}</td>
			      <td>{{$producto->precio}}</td>
			      <td>
			      	<a href="{{route('productos.edit',$producto->id)}}">Editar</a>
			      	<form action="{{route('productos.destroy',$producto->id)}}" method="POST">
			      		<input type="submit"  value="Eliminar" class="btn btn-primary">
			      		{{ method_field('DELETE')}}
			      		{{ csrf_field() }}
			      	</form>
			      </td>
			      
			    </tr>
			    @endforeach
			  </tbody>

			</table>
		
	@endsection