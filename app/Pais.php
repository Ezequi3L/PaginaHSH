<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'paises';
    protected $guarded = [];

    public function provincias(){
    	return $this->hasMany(Provincia::class);
    }
}
