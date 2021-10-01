<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
           
            $table->string('cliente');
            $table->bigInteger('nit');
            $table->dateTime('fecha');
            $table->string('tipo_venta'); 
            $table->unsignedBigInteger('id_sucursal');
            $table->string('comprobante');
            $table->decimal('total', 8, 2);
            $table->decimal('recibo', 8, 2);
            $table->decimal('cambio', 8, 2);
            $table->string('observaciones')->nullable();
            $table->string('responsable_venta');
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->foreign('id_sucursal')
            ->references('id')
            ->on('sucursals')
            ->onDelete('cascade');

            $table->foreign('id_cliente')
            ->references('id')
            ->on('clientes')
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
        Schema::dropIfExists('ventas');
    }
}