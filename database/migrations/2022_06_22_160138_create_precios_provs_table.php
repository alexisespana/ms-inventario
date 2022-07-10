<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreciosProvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precios_provs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_prod');
            $table->unsignedBigInteger('id_prov');
            $table->integer('precio');
            $table->foreign('id_prod')->references('id')->on('productos');
            $table->foreign('id_prov')->references('id')->on('proveedores');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precios_provs');
    }
}
