<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferenciasTable extends Migration
{
    
    public function up()
    {
        Schema::create('transferencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comprobante');
            $table->string('responsable_transferencia');
            $table->dateTime('fecha');
            $table->unsignedBigInteger('sucursal_origen');
            $table->string('sucursal_destino');

            $table->foreign('sucursal_origen')
            ->references('id')
            ->on('sucursals')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('transferencias');
    }
}
