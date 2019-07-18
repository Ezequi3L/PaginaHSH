<?php

use Illuminate\Database\Seeder;

class FotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=1;$i<=4;$i++) {
    		DB::table('fotos')->insert([
    			'src' => '/public/imagenes/foto'.$i.'.jpg',
          'residencia_id' => $i
    			]);

          DB::table('fotos')->insert([
            'src' => '/public/imagenes/foto5.jpg',
            'residencia_id' => 1 
            ]);
    	}



      //  factory(App\Foto::class)->times(17)->create();

    }
}
