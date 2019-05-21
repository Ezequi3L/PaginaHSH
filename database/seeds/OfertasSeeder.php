<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfertasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Oferta::class)->times(17)->create();
    }
}
