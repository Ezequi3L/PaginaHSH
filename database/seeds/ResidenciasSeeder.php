<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Residencia;
class ResidenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //      factory(App\Residencia::class)->times(17)->create();

        Residencia::create([
          'descripcion' => 'Residencia lujosa con mucha ilumunacion y amplio espacio verde', 'ubicacion_id' => 1
        ]);

        Residencia::create([
          'descripcion' => 'Casa lujosa con mucha ilumunacion y amplio espacio verde', 'ubicacion_id' => 2
        ]);

        Residencia::create([
          'descripcion' => 'Chalet lujosa con mucha ilumunacion y amplio espacio verde', 'ubicacion_id' => 3
        ]);

        Residencia::create([
          'descripcion' => 'Departamento lujoso con mucha ilumunacion y amplio espacio verde', 'ubicacion_id' => 4
        ]);

        Residencia::create([
          'descripcion' => 'Residencia lujosa con mucha ilumunacion y amplio espacio verde', 'ubicacion_id' => 2
        ]);

        Residencia::create([
          'descripcion' => 'Cabaña lujosa con mucha ilumunacion y amplio espacio verde', 'ubicacion_id' => 3
        ]);
    }
}
