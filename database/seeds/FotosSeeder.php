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
          DB::table('fotos')->insert([
            'src' => '/public/imagenes/foto6.jpg',
            'residencia_id' => 5 
            ]);
          DB::table('fotos')->insert([
            'src' => '/public/imagenes/foto7.jpg',
            'residencia_id' => 6 
            ]);
          DB::table('fotos')->insert([
            'src' => '/public/imagenes/foto8.jpg',
            'residencia_id' => 7 
            ]);
          DB::table('fotos')->insert([
            'src' => '/public/imagenes/foto9.jpg',
            'residencia_id' => 8 
            ]);
          DB::table('fotos')->insert([
            'src' => '/public/imagenes/foto10.jpg',
            'residencia_id' => 2 
            ]);
          DB::table('fotos')->insert([
            'src' => '/public/imagenes/foto11.jpg',
            'residencia_id' => 3 
            ]);
          DB::table('fotos')->insert([
            'src' => '/public/imagenes/foto12.jpg',
            'residencia_id' => 4 
            ]);     

    	}



      //  factory(App\Foto::class)->times(17)->create();

    }
}
