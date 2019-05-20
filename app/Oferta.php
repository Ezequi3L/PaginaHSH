<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subasta;

class Oferta extends Model
{
    protected $table = 'ofertas';

    protected $fillable = [
        'subasta_id','mail','monto'
    ];
    
    public function subasta(){
    	return $this->belongsTo(Subasta::class);
    }

    public function ocupado(){
    	// retorna true si para este mail hay más de una oferta hecha con la misma fecha de reserva
    	$ok = true;
    	$fechaDeEstaSub = $this->subasta->fecha_reserva;
    	$subastasConMismaFecha = Subasta::whereFecha_reserva($fechaDeEstaSub)->get();

    	foreach ($subastasConMismaFecha as $sub) {
    		$ofertas = $sub->ofertas;
    		foreach ($ofertas as $oferta) {
    			if ($oferta->mail == $this->mail) $ok = false;
    		}
    		
    	}

    	return $ok;
    }


}
