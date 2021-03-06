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
        DB::table('reservas')->truncate();
        DB::table('residencias')->truncate();
        DB::table('fotos')->truncate();
        DB::table('ubicaciones')->truncate();
        DB::table('subastas')->truncate();
        DB::table('ofertas')->truncate();
        DB::table('hotsales')->truncate();
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $this->call(UsersSeeder::class);
        $this->call(UbicacionesSeeder::class);
        $this->call(ResidenciasSeeder::class);
        $this->call(FotosSeeder::class);
        $this->call(SubastasSeeder::class);
        $this->call(OfertasSeeder::class);
        $this->call(ReservasSeeder::class);
        $this->call(HotSalesSeeder::class);
    }
}
