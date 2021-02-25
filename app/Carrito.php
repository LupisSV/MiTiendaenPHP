<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table='carritos';

    public function productos()
	{
		return $this->hasMany(Producto::class)
	}
}


