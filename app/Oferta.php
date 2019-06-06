<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subasta;
use App\User;

class Oferta extends Model
{
    protected $table = 'ofertas';

    protected $fillable = [
        'subasta_id','usr_id','monto'
    ];

    public function subasta(){
    	return $this->belongsTo(Subasta::class);
    }

    public function usuario(){
        return $this->belongsTo(User::class);   // por alguna razón no anda
    }

    public function ocupado(){
    	// retorna true si para este usuario hay más de una oferta hecha con la misma fecha de reserva
    	$ok = false;
    	$fechaDeEstaSub = $this->subasta->fecha_reserva;
    	$subastasConMismaFecha = Subasta::whereFecha_reserva($fechaDeEstaSub)->get();

    	foreach ($subastasConMismaFecha as $sub) {
    		$ofertas = $sub->ofertas;
    		foreach ($ofertas as $oferta) {
    			if ($oferta->usr_id == $this->usr_id) $ok = true;
    		}

    	}

    	return $ok;
    }


}
