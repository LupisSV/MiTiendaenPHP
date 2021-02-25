<?php

use Illuminate\Database\Seeder;

class CarritosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carritos')->insert([
          'producto_id' => 2,
          'cantidad' => 2,
          'subtotal' => 26,
          'total' => 26,
      ]);
    }
}
