<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferenciaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferencia_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo_producto');
            $table->string('nombre');
            $table->bigInteger('cantidad');
            $table->string('unidad');
            $table->decimal('precio', 8, 2);
            $table->decimal('sub_total', 8, 2);
            $table->unsignedBigInteger('id_transferencia');

            $table->foreign('id_transferencia')
            ->references('id')
            ->on('transferencias')
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
        Schema::dropIfExists('transferencia_detalles');
    }
}
