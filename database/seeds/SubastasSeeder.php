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
      factory(App\Subasta::class)->times(17)->create();
    }
}
