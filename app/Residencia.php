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

    public function ubicaciones()
    {
        return $this->belongsTo(Ubicacion::class);
    }
}
