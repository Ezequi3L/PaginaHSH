<?php

use Illuminate\Database\Seeder;
use App\Reserva;
use Carbon\Carbon;

class ReservasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //datos de prueba:
          //reservas que deberían devolverle una semana:
          Reserva::create(['usr_id' => '2', 'residencia_id' => 21, 'fecha' => Carbon::now()->addMonths(3), 'hotsale' => '0',]);
          Reserva::create(['usr_id' => '3', 'residencia_id' => 19, 'fecha' => Carbon::now()->addMonths(3), 'hotsale' => '0', 'monto' => '10000']);
          //reservas que no deberían devolverle una semana (por menos de 2 meses):
          Reserva::create(['usr_id' => '2', 'residencia_id' => 23, 'fecha' => Carbon::now()->addMonths(1), 'hotsale' => '0', 'monto' => '5000']);
          Reserva::create(['usr_id' => '5', 'residencia_id' => 21, 'fecha' => Carbon::now()->addMonths(1), 'hotsale' => '0',]);
          
          //reservas que no deberían devolverle una semana (por ser hotsale):
          Reserva::create(['usr_id' => '2', 'residencia_id' => 23, 'fecha' => Carbon::now()->addMonths(4), 'hotsale' => '1', 'monto' => '5000']);
          Reserva::create(['usr_id' => '3', 'residencia_id' => 19, 'fecha' => Carbon::now()->addMonths(4), 'hotsale' => '1', 'monto' => '15000']);
        //
        
        Reserva::create(['usr_id' => '7', 'residencia_id' => 23, 'fecha' => Carbon::now()->addMonths(3), 'hotsale' => '1', 'monto' => '5000']);
        Reserva::create(['usr_id' => '9', 'residencia_id' => 19, 'fecha' => Carbon::now()->addMonths(5), 'hotsale' => '1', 'monto' => '10000']);
        Reserva::create(['usr_id' => '13', 'residencia_id' => 4, 'fecha' => Carbon::now()->addMonths(2), 'hotsale' => '1', 'monto' => '4600']);
    }
}
