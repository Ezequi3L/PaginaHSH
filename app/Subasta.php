<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subasta extends Model
{
	protected $table = 'subastas';

	 protected $fillable = [
        'residencia_id','fecha_reserva','monto_minimo','ganada'
    ];

		public function residencia(){
			return $this->belongsTo(Residencia::class);
		}

    public function fecha_inicio(){
    	return (Carbon::createFromDate($this->fecha_reserva))->subMonths(6);
    }


    public function ofertas(){
    	return $this->hasMany(Oferta::class);
    }

    public function oferta_maxima(){
      $ret = $this->ofertas->max('monto');
    	if ( $ret != null) {
            return $ret;
        }
        else return 0;
    }

		public function activa(){
			return (((Carbon::now())>=($this->fecha_inicio()))and((Carbon::now())<=($this->fecha_inicio()->addDays(3))));
		}

		public function programada(){
			return ((Carbon::now())<=($this->fecha_inicio()));
		}

		public function finalizada(){
			return ((Carbon::now())>=($this->fecha_inicio()->addDays(3)));
		}

}
