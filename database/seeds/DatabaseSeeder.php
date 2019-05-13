<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('ubicaciones')->truncate();
        DB::table('residencias')->truncate();
        DB::table('fotos')->truncate();
        DB::table('subastas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $this->call(UbicacionSeeder::class);
        $this->call(FotosSeeder::class);
        $this->call(ResidenciasSeeder::class);
        $this->call(SubastasSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
