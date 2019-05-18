<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subasta extends Model
{
	protected $table = 'subastas';

	 protected $fillable = [
        'residencia_id','fecha_reserva','monto_minimo'
    ];

    public function fecha_inicio(){  //se invoca así $varSubasta->fecha_inicio();
    	return (Carbon::createFromDate($this->fecha_reserva))->subMonth(6);
    }
    
}
