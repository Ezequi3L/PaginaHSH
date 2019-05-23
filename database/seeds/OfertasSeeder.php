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
      //factory(App\Oferta::class)->times(17)->create();

      Oferta::create(['monto' => 1000, 'email' => 'nico1@hotmail.com', subasta_id => 1

      ]);

      Oferta::create(['monto' => 1200, 'email' => 'nico2@hotmail.com', subasta_id => 1

      ]);

      Oferta::create(['monto' => 1400, 'email' => 'nico1@hotmail.com', subasta_id => 1

      ]);

      Oferta::create(['monto' => 1500, 'email' => 'nico2@hotmail.com', subasta_id => 1

      ]);

      Oferta::create(['monto' => 1350, 'email' => 'eze1@hotmail.com', subasta_id => 2

      ]);

      Oferta::create(['monto' => 1450, 'email' => 'eze2@hotmail.com', subasta_id => 2

      ]);

      Oferta::create(['monto' => 1900, 'email' => 'eze1@hotmail.com', subasta_id => 2

      ]);

      Oferta::create(['monto' => 850, 'email' => 'tomas1@hotmail.com', subasta_id => 3

      ]);

      Oferta::create(['monto' => 1000, 'email' => 'tomas2@hotmail.com', subasta_id => 3

      ]);

      Oferta::create(['monto' => 2000, 'email' => 'tomas1@hotmail.com', subasta_id => 3

      ]);


    }
}
