<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Residencia;
class Ubicacion extends Model
{
    protected $table = 'ubicaciones';
    //
    protected $fillable = [
        'ubicacion'
    ];

    public function residencias() {
      return $this->hasMany(Residencia::class);
    }
}
