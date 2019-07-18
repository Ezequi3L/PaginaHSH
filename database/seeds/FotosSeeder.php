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
          DB::table('fotos')->insert([
            'src' => '/public/imagenes/1.jpg',
            'residencia_id' => 9
            ]);
          DB::table('fotos')->insert([
            'src' => '/public/imagenes/2.jpg',
            'residencia_id' => 10
            ]);
          DB::table('fotos')->insert([
            'src' => '/public/imagenes/3.jpg',
            'residencia_id' => 11
            ]);
          DB::table('fotos')->insert([
            'src' => '/public/imagenes/4.jpg',
            'residencia_id' => 12
            ]);
            DB::table('fotos')->insert([
              'src' => '/public/imagenes/5.jpg',
              'residencia_id' => 13
              ]);
            DB::table('fotos')->insert([
              'src' => '/public/imagenes/6.jpg',
              'residencia_id' => 14
              ]);
            DB::table('fotos')->insert([
              'src' => '/public/imagenes/7.jpg',
              'residencia_id' => 15
              ]);
            DB::table('fotos')->insert([
              'src' => '/public/imagenes/8.jpg',
              'residencia_id' => 16
              ]);
            DB::table('fotos')->insert([
              'src' => '/public/imagenes/9.jpg',
              'residencia_id' => 17
              ]);
              DB::table('fotos')->insert([
                'src' => '/public/imagenes/10.jpg',
                'residencia_id' => 18
                ]);
              DB::table('fotos')->insert([
                'src' => '/public/imagenes/11.jpg',
                'residencia_id' => 19
                ]);
              DB::table('fotos')->insert([
                'src' => '/public/imagenes/12.jpg',
                'residencia_id' => 20
                ]);
              DB::table('fotos')->insert([
                'src' => '/public/imagenes/13.jpg',
                'residencia_id' => 21
                ]);
              DB::table('fotos')->insert([
                'src' => '/public/imagenes/14.jpg',
                'residencia_id' => 22
                ]);
                DB::table('fotos')->insert([
                  'src' => '/public/imagenes/15.jpg',
                  'residencia_id' => 23
                  ]);
                DB::table('fotos')->insert([
                  'src' => '/public/imagenes/16.jpg',
                  'residencia_id' => 24
                  ]);
                DB::table('fotos')->insert([
                  'src' => '/public/imagenes/17.jpg',
                  'residencia_id' => 25
                  ]);
                DB::table('fotos')->insert([
                  'src' => '/public/imagenes/18.jpg',
                  'residencia_id' => 26
                  ]);
                DB::table('fotos')->insert([
                  'src' => '/public/imagenes/19.jpg',
                  'residencia_id' => 27
                  ]);
                  DB::table('fotos')->insert([
                    'src' => '/public/imagenes/20.jpg',
                    'residencia_id' => 28
                    ]);
                  DB::table('fotos')->insert([
                    'src' => '/public/imagenes/21.jpg',
                    'residencia_id' => 29
                    ]);
                  DB::table('fotos')->insert([
                    'src' => '/public/imagenes/22.jpg',
                    'residencia_id' => 30
                    ]);
                  DB::table('fotos')->insert([
                    'src' => '/public/imagenes/23.jpg',
                    'residencia_id' => 31
                    ]);
                  DB::table('fotos')->insert([
                    'src' => '/public/imagenes/24.jpg',
                    'residencia_id' => 32
                    ]);
                    DB::table('fotos')->insert([
                      'src' => '/public/imagenes/25.jpg',
                      'residencia_id' => 33
                      ]);
                    DB::table('fotos')->insert([
                      'src' => '/public/imagenes/26.jpg',
                      'residencia_id' => 34
                      ]);
                    DB::table('fotos')->insert([
                      'src' => '/public/imagenes/27.jpg',
                      'residencia_id' => 35
                      ]);
                    DB::table('fotos')->insert([
                      'src' => '/public/imagenes/28.jpg',
                      'residencia_id' => 36
                      ]);
                    DB::table('fotos')->insert([
                      'src' => '/public/imagenes/29.jpg',
                      'residencia_id' => 37
                      ]);
                      DB::table('fotos')->insert([
                        'src' => '/public/imagenes/30.jpg',
                        'residencia_id' => 38
                        ]);
                      DB::table('fotos')->insert([
                        'src' => '/public/imagenes/17.jpg',
                        'residencia_id' => 39
                        ]);
                      DB::table('fotos')->insert([
                        'src' => '/public/imagenes/22.jpg',
                        'residencia_id' => 40
                        ]);
                        DB::table('fotos')->insert([
                          'src' => '/public/imagenes/6.jpg',
                          'residencia_id' => 41
                          ]);
                        DB::table('fotos')->insert([
                          'src' => '/public/imagenes/7.jpg',
                          'residencia_id' => 42
                          ]);
                        DB::table('fotos')->insert([
                          'src' => '/public/imagenes/8.jpg',
                          'residencia_id' => 43
                          ]);
                        DB::table('fotos')->insert([
                          'src' => '/public/imagenes/9.jpg',
                          'residencia_id' => 44
                          ]);
                          DB::table('fotos')->insert([
                            'src' => '/public/imagenes/10.jpg',
                            'residencia_id' => 45
                            ]);
                          DB::table('fotos')->insert([
                            'src' => '/public/imagenes/11.jpg',
                            'residencia_id' => 46
                            ]);
                          DB::table('fotos')->insert([
                            'src' => '/public/imagenes/12.jpg',
                            'residencia_id' => 47
                            ]);
                          DB::table('fotos')->insert([
                            'src' => '/public/imagenes/13.jpg',
                            'residencia_id' => 48
                            ]);
                          DB::table('fotos')->insert([
                            'src' => '/public/imagenes/14.jpg',
                            'residencia_id' => 49
                            ]);
                            DB::table('fotos')->insert([
                              'src' => '/public/imagenes/15.jpg',
                              'residencia_id' => 50
                              ]);
    	}



      //  factory(App\Foto::class)->times(17)->create();

    }
}
