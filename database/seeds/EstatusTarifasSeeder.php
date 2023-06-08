<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstatusTarifasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('estatus_tarifas')->insert([
            'estatus' => 'en solicitud'
        ]);

        DB::table('estatus_tarifas')->insert([
            'estatus' => 'aprobada'
        ]);
    }
}
