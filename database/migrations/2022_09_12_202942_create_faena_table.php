<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaenaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faena', function (Blueprint $table) {
            $table->integer('fae_codigo',true);
            $table->string('fae_nro_lote');
            $table->date('fae_fecha');
            $table->integer('prov_codigo');
            $table->integer('loc_codigo');
            $table->string('fae_entregado_por')->nullable();
            $table->string('fae_hecho_por')->nullable();
            $table->string('fae_destino')->nullable();
            $table->string('com_nro_comprobante')->nullable();
            $table->integer('com_codigo')->nullable();
            $table->integer('user_id');
            
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
        Schema::dropIfExists('faena');
    }
}
