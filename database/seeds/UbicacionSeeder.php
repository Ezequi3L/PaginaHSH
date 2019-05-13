<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Ubicacion::class)->times(17)->create();
    }
}
