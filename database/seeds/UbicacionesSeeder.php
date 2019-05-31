<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Ubicacion;
class UbicacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //      factory(App\Residencia::class)->times(17)->create();

      Ubicacion::create(['ubicacion' => 'La Plata, Buenos Aires, Argentina']);
      Ubicacion::create(['ubicacion' => 'Berisso, Buenos Aires, Argentina']);
      Ubicacion::create(['ubicacion' => 'Ensenada, Buenos Aires, Argentina']);
      Ubicacion::create(['ubicacion' => 'Paris, Francia']);
      Ubicacion::create(['ubicacion' => 'Madrid, España']);
    }
}
