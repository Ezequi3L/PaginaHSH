<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residencia extends Model
{
    protected $table = 'residencias';
    //
    protected $fillable = [
        'descripcion','ubicacion_id','foto_id'
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function foto() {
    	return $this->belongsTo(Foto::class);
    }
}
