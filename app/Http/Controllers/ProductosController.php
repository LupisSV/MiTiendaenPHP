<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos= DB::table('productos')->get();
        return view('productos.index',compact('productos'));
        //return 'Todos los productos';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        return view('productos.create');
        //return 'Formulario para crear productos';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required|string',
            'descripcion'=>'required|string'
        ]);

        DB::table('productos')->insert([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('status','El producto ha sido agregado existosamente');
        //return 'Guardar un nuevo usuario';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'Producto con ID #' .$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto= DB::table('productos')->where('id',$id)->first();
        return view('productos.edit', compact('producto'));  
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
        
        DB::table('productos')->where('id',$id)->update($request->only('nombre','descripcion','precio')); 
        return back()->with('status','El producto ha sido actualizado existosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('productos')->where('id',$id)->delete();
        return back()->with('status','El producto se ha eliminado existosamente');
    }
}
