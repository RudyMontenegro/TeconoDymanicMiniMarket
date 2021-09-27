<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentaCobrarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuenta_cobrars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cliente');
            $table->date('fecha_cobro');
            $table->string('hora_cobro');
            $table->decimal('monto_cobrado', 8, 2);
            $table->decimal('saldo', 8, 2);
            $table->string('tipo_cobro');
            $table->string('observaciones');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_venta');

            $table->foreign('id_cliente')
            ->references('id')
            ->on('clientes')
            ->onDelete('cascade');

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
        Schema::dropIfExists('cuenta_cobrars');
    }
}
