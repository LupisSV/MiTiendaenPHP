<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CarritosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carritos = DB::table('productos')->get();
        return view('productos.carrito',compact('carritos'));
        //return 'Todos los registros';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.carrito');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        //return $request->id;

        for($i=0; $i<count($request->id); $i++){    
            DB::table('carritos')->insert([
                'producto_id' => $request->id[$i],
                'cantidad' => $request->cantidad[$i],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return back()->with('status','Su compra se hizo con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'Carrito con ID #' .$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'Formulario para editar carrito con ID #' .$id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return 'Actualizar carrito con ID #' .$id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'Eliminar carrito con ID #' .$id;
    }
}
