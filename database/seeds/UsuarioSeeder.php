<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('rols')->insert([
            'rol' => 'admin'
        ]);

        DB::table('rols')->insert([
            'rol' => 'prospectador'
        ]);

        $user = new User();
        $user->name = 'Julio Olvera';
        $user->email = 'sistemas@mrollogistics.com.mx';
        $user->username= 'Jolveroo';
        $user->password = Hash::make('Logistics1903');
        $user->rol_id = '1';

        $user->save();


        $user = new User();
        $user->name = 'Lilia A. Olvera Romero';
        $user->email = 'direccionoperaciones@mrollogistics.com.mx';
        $user->username= 'Lolveroo';
        $user->password = Hash::make('Logistics1903');
        $user->rol_id = '1';

        $user->save();


        $user = new User();
        $user->name = 'ZTE';
        $user->email = 'zte@zte.com';
        $user->password = Hash::make('Logistics1903');
        $user->username= 'zte';
        $user->rol_id = '1';

        $user->save();
    }
}
