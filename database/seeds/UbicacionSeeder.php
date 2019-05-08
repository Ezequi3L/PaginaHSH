<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ubicaciones')->insert(['ciudad' => 'La Plata', 'provincia' => 'Buenos Aires']);
        DB::table('ubicaciones')->insert(['ciudad' => 'Berisso', 'provincia' => 'Buenos Aires']);
        DB::table('ubicaciones')->insert(['ciudad' => 'Ensenada', 'provincia' => 'Buenos Aires']);
        DB::table('ubicaciones')->insert(['ciudad' => 'Mar del Plata', 'provincia' => 'Buenos Aires']);
        DB::table('ubicaciones')->insert(['ciudad' => 'Usuahia', 'provincia' => 'Tierra del Fuego']);
        DB::table('ubicaciones')->insert(['ciudad' => 'Rawson', 'provincia' => 'Chubut']);
        DB::table('ubicaciones')->insert(['ciudad' => 'S.F.d.V.d.Catamarca', 'provincia' => 'Catamarca']);
        DB::table('ubicaciones')->insert(['ciudad' => 'Posadas', 'provincia' => 'Misiones']);





    }
}
