<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ventas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('cod_operacion');
            $table->integer('medio_pago');
            $table->integer('suma_prod')->default(0);
            $table->json('cant_prods');
            $table->string('valor_compra');
            $table->string('pagado')->default(0);
            $table->string('cambio')->default(0);
            $table->integer('procesada');
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
        Schema::dropIfExists('ventas');
    }
}
