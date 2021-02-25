<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table='compras';

    public function carritos()
	{
		return $this->hasOne(Carrito::class);
	}
}


