<?php

use Illuminate\Database\Seeder;

class Productos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
          'nombre' => 'paleta',
          'descripcion' => 'pollito',
          'precio' => 13,]);

          DB::table('productos')->insert([
          'nombre' => 'papitas',
          'descripcion' => 'sabritas habanero',
          'precio' => 13,
        ]);
    }
}
