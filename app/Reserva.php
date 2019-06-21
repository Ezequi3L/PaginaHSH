<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';
    //
    protected $fillable = [
        'residencia_id','usr_id','fecha','hotsale',
    ];

    public function residencia()
    {
        return $this->belongsTo(Residencia::class);
    }

    public function usuario() {
    	return $this->belongsTo(User::class);
    }

}
