<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Productos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->unsignedBigInteger('categoria');
            $table->unsignedBigInteger('unidad_medida');
            $table->string('imagen')->nullable();
            $table->string('promo')->nullable();
            $table->timestamps();
            $table->foreign('categoria')->references('id')->on('categoria');
            $table->foreign('unidad_medida')->references('id')->on('unidad_medida');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
