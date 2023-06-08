<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estatus_tarifas', function (Blueprint $table) {
            $table->id();
            $table->string('estatus');
            $table->timestamps();
        });
        Schema::create('tarifas', function (Blueprint $table) {
            $table->id();
            $table->decimal('tarifa');
            $table->foreignId('estatus_id')->references('id')->on('estatus_tarifas');
            $table->timestamps();
        });


        Schema::create('prospectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('empresa');
            $table->string('correo');
            $table->foreignId('estado_id')->default(1)->references('id')->on('estados');
            $table->foreignId('tarifa_id')->nullable()->references('id')->on('tarifas');
            $table->foreignId('servicio_id')->references('id')->on('servicios');
            $table->bigInteger('user_id');
            $table->uuid('cotizacion_id')->nullable();
            $table->uuid('cliente_uuid')->nullable();
            $table->uuid('comentario_id')->nullable();
            $table->timestamps();
        });

        Schema::create('recordatorios', function (Blueprint $table) {
            $table->id();
            $table->string('asunto');
            $table->dateTime('fecha');
            $table->string('fecha_recordatorio');
            $table->foreignId('prospecto_id')->references('id')->on('prospectos');
            $table->bigInteger('user_id');
            $table->string('read')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prospectos');
    }
}
