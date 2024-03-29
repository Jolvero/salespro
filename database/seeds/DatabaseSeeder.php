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
        // $this->call(UsersTableSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(ServicioSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(EstatusTarifasSeeder::class);
    }
}
