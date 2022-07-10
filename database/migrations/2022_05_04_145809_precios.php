<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Precios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_prod')->unique();
            $table->integer('precio');
            $table->integer('precio_promo')->nullable();
            $table->string('fecha_inicio');
            $table->string('fecha_fin');
            $table->integer('vigente');
            $table->foreign('id_prod')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precios');
    }
}
