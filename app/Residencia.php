<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residencia extends Model
{
    protected $table = 'residencias';
    //
    protected $fillable = [
        'descripcion','ubicacion_id','dada_de_baja','ubicacion_precisa'
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function fotos() {
    	return $this->hasMany(Foto::class);
    }

}
