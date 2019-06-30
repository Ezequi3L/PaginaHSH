<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class HotSale extends Model
{
  protected $table = 'hotsales';

  protected $fillable = [
      'residencia_id','monto','fecha_reserva',
  ];

  public function residencia(){
    return $this->belongsTo(Residencia::class);
  }

  public function usuario(){
    return $this->belongsTo(User::class);
  }

  public function activa(){
    return ((Carbon::now())<=(Carbon::createFromDate($this->fecha_reserva)));
  }

  public function finalizada(){
    return ((Carbon::now())>(Carbon::createFromDate($this->fecha_reserva)));
  }
}
