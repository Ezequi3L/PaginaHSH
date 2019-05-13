<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResidenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Residencia::class)->times(17)->create();

        //
    }
}
