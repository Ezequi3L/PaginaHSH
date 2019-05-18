<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subasta extends Model
{
	protected $table = 'subastas';

	 protected $fillable = [
        'residencia_id','fecha_reserva','monto_minimo'
    ];
    
}
