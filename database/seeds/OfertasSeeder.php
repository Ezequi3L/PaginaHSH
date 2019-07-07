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

        Oferta::create(['monto' => 1000, 'usr_id' => '2', 'subasta_id' => 1

        ]);

        Oferta::create(['monto' => 1200, 'usr_id' => '2', 'subasta_id' => 1

        ]);

        Oferta::create(['monto' => 1400, 'usr_id' => '3', 'subasta_id' => 1

        ]);

        Oferta::create(['monto' => 1500, 'usr_id' => '2', 'subasta_id' => 1

        ]);

        Oferta::create(['monto' => 1350, 'usr_id' => '3', 'subasta_id' => 2

        ]);

        Oferta::create(['monto' => 1450, 'usr_id' => '2', 'subasta_id' => 2

        ]);

        Oferta::create(['monto' => 1900, 'usr_id' => '3', 'subasta_id' => 2

        ]);

        Oferta::create(['monto' => 850, 'usr_id' => '3', 'subasta_id' => 3

        ]);

        Oferta::create(['monto' => 1000, 'usr_id' => '2', 'subasta_id' => 3

        ]);

        Oferta::create(['monto' => 2000, 'usr_id' => '2', 'subasta_id' => 3

        ]);

        Oferta::create(['monto' => 6523, 'usr_id' => '3', 'subasta_id' => 5

        ]);

        Oferta::create(['monto' => 1200, 'usr_id' => '2', 'subasta_id' => 5

        ]);

        Oferta::create(['monto' => 23, 'usr_id' => '2', 'subasta_id' => 5

        ]);

        Oferta::create(['monto' => 987, 'usr_id' => '3', 'subasta_id' => 5

        ]);


    }
}
