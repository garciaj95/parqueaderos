<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->id();
            $table->string('placa', 20)->unique();
            $table->integer('modelo_id')->unsigned();
            $table->integer('tipo_id')->unsigned();
            $table->integer('anio');
            $table->string('color', 50)->nullable();
            $table->string('detalle', 300)->nullable();
            $table->string('propietario_id', 15)->default(NULL);
            $table->softDeletes();
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
        Schema::dropIfExists('vehiculo');
    }
}
