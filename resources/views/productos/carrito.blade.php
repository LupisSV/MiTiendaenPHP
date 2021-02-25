@extends('layout')
@section('content')


<section>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1>Carrito de compras</h1>
				<p align="center">A continuación te presentamos toda la lista de nuestros productos que puedes comprar ¡recuerda que tenemos la mejor calidad!</p>	
			</div>
		</div>
	</div>				
</section>

<section>
	<div class="container">
        <div class="row">
            <!-- Elementos generados a partir del JSON -->
            <main id="items" class="col-sm-8 row"></main>
            <!-- Carrito -->
            <aside class="col-sm-4">
            	<form action="{{route('carritos.store')}}" method="post">
            		@if (session()->has('status'))
						<div class="alert alert-success">
							{{session('status')}}
						</div>
						
					@endif
            		<h2>Carrito</h2>
	                <!-- Elementos del carrito -->
	                <ul id="carrito" class="list-group"></ul>
	                <hr>
	                <!-- Precio total -->
	                <p class="text-right">Total: $ <span id="total"></span></p>
	                <button id="boton-vaciar" class="btn btn-danger">Vaciar</button>
	                <input type="submit" id="boton-comprar" class="btn btn-success" value="Comprar">
	                {{ csrf_field() }}
            	</form>	                
            </aside>
        </div>
    </div>				
</section>

@endsection

<script>
    window.onload = function () {
        // Variables
        let baseDeDatos = [
            
        @foreach ($carritos as $carrito)	

			{
				id: "{{$carrito->id}}",
				nombre: "{{$carrito->descripcion}}",
				precio: {{$carrito->precio}},
				imagen: 'https://source.unsplash.com/random/500x500/?potato&sig={{$carrito->id}}'
			},

		@endforeach

        ];
        
        let $items = document.querySelector('#items');
        let carrito = [];
        let total = 0;
        let $carrito = document.querySelector('#carrito');
        let $total = document.querySelector('#total');
        let $botonVaciar = document.querySelector('#boton-vaciar');
        let $botonComprar = document.querySelector('#boton-comprar');

        // Funciones
        function renderItems() {
            for (let info of baseDeDatos) {
                // Estructura
                let miNodo = document.createElement('div');
                miNodo.classList.add('card', 'col-sm-4');
                // Body
                let miNodoCardBody = document.createElement('div');
                miNodoCardBody.classList.add('card-body');
                // Titulo
                let miNodoTitle = document.createElement('h5');
                miNodoTitle.classList.add('card-title');
                miNodoTitle.textContent = info['nombre'];
                // Imagen
                let miNodoImagen = document.createElement('img');
                miNodoImagen.classList.add('img-fluid');
                miNodoImagen.setAttribute('src', info['imagen']);
                // Precio
                let miNodoPrecio = document.createElement('p');
                miNodoPrecio.classList.add('card-text');
                miNodoPrecio.textContent = '$ ' + info['precio'];
                // Boton 
                let miNodoBoton = document.createElement('button');
                miNodoBoton.classList.add('btn', 'btn-primary');
                miNodoBoton.textContent = '+';
                miNodoBoton.setAttribute('marcador', info['id']);
                miNodoBoton.addEventListener('click', anyadirCarrito);
                // Insertamos
                miNodoCardBody.appendChild(miNodoImagen);
                miNodoCardBody.appendChild(miNodoTitle);
                miNodoCardBody.appendChild(miNodoPrecio);
                miNodoCardBody.appendChild(miNodoBoton);
                miNodo.appendChild(miNodoCardBody);
                $items.appendChild(miNodo);
            }
        }

        function anyadirCarrito () {
            // Anyadimos el Nodo a nuestro carrito
            carrito.push(this.getAttribute('marcador'));
            // Calculo el total
            calcularTotal();
            // Renderizamos el carrito 
            renderizarCarrito();
        }

        function renderizarCarrito() {
        	//Validamos si se muestra o no el botón de carrito
        	botonComprar();
            // Vaciamos todo el html
            $carrito.textContent = '';
            // Quitamos los duplicados
            let carritoSinDuplicados = [...new Set(carrito)];
            // Generamos los Nodos a partir de carrito
            carritoSinDuplicados.forEach(function (item, indice) {
                // Obtenemos el item que necesitamos de la variable base de datos
                let miItem = baseDeDatos.filter(function(itemBaseDatos) {
                    return itemBaseDatos['id'] == item;
                });
                // Cuenta el número de veces que se repite el producto
                let numeroUnidadesItem = carrito.reduce(function (total, itemId) {
                    return itemId === item ? total += 1 : total;
                }, 0);
                // Creamos el nodo del item del carrito
                let miNodo = document.createElement('li');
                miNodo.classList.add('list-group-item', 'text-right', 'mx-2');
                miNodo.textContent = `${numeroUnidadesItem} x ${miItem[0]['nombre']} - $ ${miItem[0]['precio']}`;
                // Boton de borrar
                let miBoton = document.createElement('button');
                miBoton.classList.add('btn', 'btn-danger', 'mx-5');
                miBoton.textContent = 'X';
                miBoton.style.marginLeft = '1rem';
                miBoton.setAttribute('item', item);
                miBoton.addEventListener('click', borrarItemCarrito);

                // Mezclamos nodos
                miNodo.appendChild(miBoton);
                $carrito.appendChild(miNodo);

                // Creamos el nodo para input ID del item del carrito
                let miInputID = document.createElement('input');
                miInputID.type = 'hidden';
                miInputID.name = 'id[]';
                miInputID.value = `${miItem[0]['id']}`;
                // Mezclamos nodos
                $carrito.appendChild(miInputID);

                // Creamos el nodo para input Cantidad del item del carrito
                let miInputCantidad = document.createElement('input');
                miInputCantidad.type = 'hidden';
                miInputCantidad.name = 'cantidad[]';
                miInputCantidad.value = `${numeroUnidadesItem}`;
                // Mezclamos nodos
                $carrito.appendChild(miInputCantidad);
            });
        }

        function borrarItemCarrito() {
            // Obtenemos el producto ID que hay en el boton pulsado
            let id = this.getAttribute('item');
            // Borramos todos los productos
            carrito = carrito.filter(function (carritoId) {
                return carritoId !== id;
            });
            // volvemos a renderizar
            renderizarCarrito();
            // Calculamos de nuevo el precio
            calcularTotal();
        }

        function calcularTotal() {
            // Limpiamos precio anterior
            total = 0;
            // Recorremos el array del carrito
            for (let item of carrito) {
                // De cada elemento obtenemos su precio
                let miItem = baseDeDatos.filter(function(itemBaseDatos) {
                    return itemBaseDatos['id'] == item;
                });
                total = total + miItem[0]['precio'];
            }
            // Formateamos el total para que solo tenga dos decimales
            let totalDosDecimales = parseFloat(total).toFixed(2);
            // Renderizamos el precio en el HTML
            $total.textContent = totalDosDecimales;
        }

        function vaciarCarrito() {
            // Limpiamos los productos guardados
            carrito = [];
            // Renderizamos los cambios
            renderizarCarrito();
            calcularTotal();
            botonComprar();
        }

        // Eventos
        $botonVaciar.addEventListener('click', vaciarCarrito);

        //Validar botón comprar

        function botonComprar(){
        	if(carrito.length>0){
        		$("#boton-comprar").show();
        	}
        	else{
        		$("#boton-comprar").hide();
        	}
        }

        // Inicio
        renderItems();
    } 
</script>