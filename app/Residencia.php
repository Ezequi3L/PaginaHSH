<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residencia extends Model
{
    protected $table = 'residencias';
    //
    protected $fillable = [
        'descripcion','localidad_id','dada_de_baja'
    ];

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }

    public function fotos() {
    	return $this->hasMany(Foto::class);
    }

}
