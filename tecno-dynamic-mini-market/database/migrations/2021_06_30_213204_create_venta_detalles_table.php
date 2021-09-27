<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo_producto')->nullable();
            $table->string('nombre')->nullable();
            $table->bigInteger('cantidad')->nullable();
            $table->string('unidad')->nullable();//no tratado
            $table->decimal('precio', 8, 2)->nullable();
            $table->decimal('sub_total', 8, 2)->nullable();
            $table->unsignedBigInteger('id_venta')->nullable();

            $table->foreign('id_venta')
            ->references('id')
            ->on('ventas')
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
        Schema::dropIfExists('venta_detalles');
    }
}