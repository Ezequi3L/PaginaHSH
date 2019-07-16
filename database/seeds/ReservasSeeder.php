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
        Reserva::create(['usr_id' => '2', 'residencia_id' => 21, 'fecha' => Carbon::now()->addMonths(1), 'hotsale' => '0',]);

        Reserva::create(['usr_id' => '2', 'residencia_id' => 23, 'fecha' => Carbon::now()->addMonths(2), 'hotsale' => '1', 'monto' => '5000']);

        Reserva::create(['usr_id' => '3', 'residencia_id' => 19, 'fecha' => Carbon::now()->addMonths(1), 'hotsale' => '1', 'monto' => '10000']);

        Reserva::create(['usr_id' => '3', 'residencia_id' => 4, 'fecha' => Carbon::now()->addMonths(2), 'hotsale' => '1', 'monto' => '4600']);
    }
}
