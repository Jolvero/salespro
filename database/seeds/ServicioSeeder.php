<?php

use App\Servicio;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $servicio = new Servicio();
        $servicio->servicio = 'importación-exportación';

        $servicio->save();

        $servicio2 = new Servicio();
        $servicio2->servicio = 'comercializadora';

        $servicio2->save();

        $servicio3 = new Servicio();
        $servicio3->servicio = 'capacitación empresarial';

        $servicio3->save();

        $servicio4 = new Servicio();
        $servicio4->servicio = 'transporte';

        $servicio4->save();

        $servicio5 = new Servicio();
        $servicio5->servicio = 'seguros';

        $servicio5->save();

        $servicio6 = new Servicio();
        $servicio6->servicio = 'door to door';

        $servicio6->save();

        $servicio7 = new Servicio();
        $servicio7->servicio = 'investigación de mercados';

        $servicio7->save();

        $servicio8 = new Servicio();
        $servicio8->servicio = 'asesoría legal de seguridad y derecho aduanero';

        $servicio8->save();

        $servicio9 = new Servicio();
        $servicio9->servicio = 'Monitoreo';

        $servicio9->save();

        $servicio10 = new Servicio();
        $servicio10->servicio = 'custodia';

        $servicio10->save();
    }
}
