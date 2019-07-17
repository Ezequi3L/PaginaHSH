<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\HotSale;
class HotSalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	HotSale::create(['residencia_id' => '50', 'fecha_reserva' => Carbon::now()->addMonths(4), 'monto' => '5000']);
    	HotSale::create(['residencia_id' => '29', 'fecha_reserva' => Carbon::now()->addMonths(5), 'monto' => '7500']);

    	HotSale::create(['residencia_id' => '47', 'fecha_reserva' => Carbon::now()->subMonths(1), 'monto' => '4300']);
		HotSale::create(['residencia_id' => '14', 'fecha_reserva' => Carbon::now()->subMonths(2), 'monto' => '3400']);
    }
}
