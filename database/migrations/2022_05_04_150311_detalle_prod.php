<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetalleProd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_prod', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_prod');
            $table->string('descripcion');
            $table->timestamps();
            // $table->foreign('id_marca')->references('id')->on('marca_prod');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_prod');
    }
}
