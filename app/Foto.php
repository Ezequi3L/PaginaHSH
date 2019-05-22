<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
  protected $table = 'fotos';
  //
  protected $fillable = [
      'src', 'residencia_id'
  ];

  public function residencia(){
    return $this->belongsTo(Residencia::class);
  }

}
