<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Oferta;
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

        Oferta::create(['monto' => 1000, 'mail' => 'nico1@hotmail.com', 'subasta_id' => 1

        ]);

        Oferta::create(['monto' => 1200, 'mail' => 'nico2@hotmail.com', 'subasta_id' => 1

        ]);

        Oferta::create(['monto' => 1400, 'mail' => 'nico1@hotmail.com', 'subasta_id' => 1

        ]);

        Oferta::create(['monto' => 1500, 'mail' => 'nico2@hotmail.com', 'subasta_id' => 1

        ]);

        Oferta::create(['monto' => 1350, 'mail' => 'eze1@hotmail.com', 'subasta_id' => 2

        ]);

        Oferta::create(['monto' => 1450, 'mail' => 'eze2@hotmail.com', 'subasta_id' => 2

        ]);

        Oferta::create(['monto' => 1900, 'mail' => 'eze1@hotmail.com', 'subasta_id' => 2

        ]);

        Oferta::create(['monto' => 850, 'mail' => 'tomas1@hotmail.com', 'subasta_id' => 3

        ]);

        Oferta::create(['monto' => 1000, 'mail' => 'tomas2@hotmail.com', 'subasta_id' => 3

        ]);

        Oferta::create(['monto' => 2000, 'mail' => 'tomas1@hotmail.com', 'subasta_id' => 3

        ]);

    }
}
