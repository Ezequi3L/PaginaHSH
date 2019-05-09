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
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $this->call(UbicacionSeeder::class);
        $this->call(ResidenciasSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
