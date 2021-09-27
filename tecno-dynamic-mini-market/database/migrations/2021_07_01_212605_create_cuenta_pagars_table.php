<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentaPagarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuenta_pagars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_pago');
            $table->string('hora_pago');
            $table->decimal('monto_cancelado', 8, 2);
            $table->decimal('saldo', 8, 2);
            $table->string('tipo_pago');
            $table->string('observaciones');
            $table->unsignedBigInteger('id_proveedor');
            $table->unsignedBigInteger('id_compra');

             $table->foreign('id_proveedor')
            ->references('id')
            ->on('proveedors')
            ->onDelete('cascade');

            $table->foreign('id_compra')
            ->references('id')
            ->on('compras')
            ->onDelete('cascade');

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
        Schema::dropIfExists('cuenta_pagars');
    }
}
