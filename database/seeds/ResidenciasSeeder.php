<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResidenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('residencias')
        ->insert(['descripcion' => 'Lujosa residencia con amplias habitaciones, muy luminosa y con mucho espacio verde',
                  'ubicacion_id' => 'DB::table('ubicaciones')->select('id')->where(['ciudad' => 'La Plata', 'provincia' => 'Buenos Aires'])->value('id');']);

        DB::table('residencias')
        ->insert(['descripcion' => 'Lujosa residencia con amplias habitaciones, muy luminosa y con mucho espacio verde',
                  'ubicacion_id' => 'DB::table('ubicaciones')->select('id')->where(['ciudad' => 'Berisso', 'provincia' => 'Buenos Aires'])->value('id');']);

        DB::table('residencias')
        ->insert(['descripcion' => 'Lujosa residencia con amplias habitaciones, muy luminosa y con mucho espacio verde',
                  'ubicacion_id' => 'DB::table('ubicaciones')->select('id')->where(['ciudad' => 'Ensenada', 'provincia' => 'Buenos Aires'])->value('id');']);

        DB::table('residencias')
        ->insert(['descripcion' => 'Lujosa residencia con amplias habitaciones, muy luminosa y con mucho espacio verde',
                  'ubicacion_id' => 'DB::table('ubicaciones')->select('id')->where(['ciudad' => 'Mat del Plata', 'provincia' => 'Buenos Aires'])->value('id');']);

        DB::table('residencias')
        ->insert(['descripcion' => 'Lujosa residencia con amplias habitaciones, muy luminosa y con mucho espacio verde',
                  'ubicacion_id' => 'DB::table('ubicaciones')->select('id')->where(['ciudad' => 'La Plata', 'provincia' => 'Buenos Aires'])->value('id');']);

        //
    }
}
