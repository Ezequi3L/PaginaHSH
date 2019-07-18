<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Subasta;
class SubastasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Subasta::create(['residencia_id' => '20', 'fecha_reserva' => Carbon::now()->addMonths(1), 'monto_minimo' => '3000', 'ganada' => '0']);
    	Subasta::create(['residencia_id' => '15', 'fecha_reserva' => Carbon::now()->addMonths(1), 'monto_minimo' => '1400', 'ganada' => '0']);
    	Subasta::create(['residencia_id' => '10', 'fecha_reserva' => Carbon::now()->addMonths(3), 'monto_minimo' => '1200', 'ganada' => '0']);
    	Subasta::create(['residencia_id' => '5', 'fecha_reserva' => Carbon::now()->addMonths(4), 'monto_minimo' => '4000', 'ganada' => '0']);
    	Subasta::create(['residencia_id' => '42', 'fecha_reserva' => Carbon::now()->addMonths(1), 'monto_minimo' => '3200', 'ganada' => '0']);
    	Subasta::create(['residencia_id' => '34', 'fecha_reserva' => Carbon::now()->addYears(1), 'monto_minimo' => '7000', 'ganada' => '0']);
    	Subasta::create(['residencia_id' => '36', 'fecha_reserva' => Carbon::now()->addMonths(2), 'monto_minimo' => '6000', 'ganada' => '0']);
    	Subasta::create(['residencia_id' => '23', 'fecha_reserva' => Carbon::now()->addMonths(8), 'monto_minimo' => '2000', 'ganada' => '0']);
    	Subasta::create(['residencia_id' => '31', 'fecha_reserva' => Carbon::now()->addMonths(9), 'monto_minimo' => '1500', 'ganada' => '0']);
    	Subasta::create(['residencia_id' => '28', 'fecha_reserva' => Carbon::now()->addMonths(3), 'monto_minimo' => '2300', 'ganada' => '0']);
    	Subasta::create(['residencia_id' => '18', 'fecha_reserva' => Carbon::now()->addMonths(6), 'monto_minimo' => '5000', 'ganada' => '0']);
    	Subasta::create(['residencia_id' => '12', 'fecha_reserva' => Carbon::now()->addMonths(5), 'monto_minimo' => '2400', 'ganada' => '0']);

      //factory(App\Subasta::class)->times(17)->create();
    }
}
