<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecioComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precio_compra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_stock');
            $table->string('precio')->nullable()->default(0);
            $table->string('fecha');
            $table->foreign('id_stock')->references('id')->on('stock')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precio_compras');
    }
}
