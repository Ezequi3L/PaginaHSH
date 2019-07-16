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

      Ubicacion::create(['ubicacion' => 'Mar  Del Plata, Buenos Aires, Argentina']);
      Ubicacion::create(['ubicacion' => 'CABA, Buenos Aires, Argentina']);
      Ubicacion::create(['ubicacion' => 'Posadas, Misiones, Argentina']);
      Ubicacion::create(['ubicacion' => 'Paris, Francia']);
      Ubicacion::create(['ubicacion' => 'Madrid, España']);
      Ubicacion::create(['ubicacion' => 'Roma, Italia']);
      Ubicacion::create(['ubicacion' => 'Tokio, Japon']);
      Ubicacion::create(['ubicacion' => 'Monaco']);
      Ubicacion::create(['ubicacion' => 'Nueva York, EEUU']);
      Ubicacion::create(['ubicacion' => 'Orlando, EEUU']);
    }
}
