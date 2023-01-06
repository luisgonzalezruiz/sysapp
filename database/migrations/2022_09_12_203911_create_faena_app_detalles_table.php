<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaenaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faena_app_detalles', function (Blueprint $table) {
            $table->integer('fd_item',true);
            $table->string('fae_nro_lote');
            $table->integer('fae_codigo');
            $table->string('fd_tarjeta');
            $table->decimal('fd_kilos', 18, 5);
            $table->integer('pro_codigo');
            $table->integer('cla_codigo')->default(1);

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
        Schema::dropIfExists('faena_app_detalles');
    }
}
