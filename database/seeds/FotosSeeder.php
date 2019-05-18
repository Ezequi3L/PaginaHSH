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
    	for ($i=1;$i<=5;$i++) {
    		DB::table('fotos')->insert([
    			'src' => '/public/imagenes/foto'.$i.'.jpg',
    			]);
    	}



      //  factory(App\Foto::class)->times(17)->create();
        
    }
}
