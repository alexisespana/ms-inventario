<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VentasProd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_prod', function (Blueprint $table) {
            $table->unsignedBigInteger('id_venta');
            $table->unsignedBigInteger('id_prod');
            $table->foreign('id_venta')->references('id')->on('ventas')->onDelete('cascade');
            $table->foreign('id_prod')->references('id')->on('productos')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_prod');
    }
}
