<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('codigo_barra');
            $table->string('nombre');
            $table->string('marca');
            $table->decimal('precio_costo', 8, 2);
            $table->decimal('precio_venta_mayor', 8, 2);
            $table->decimal('precio_venta_menor', 8, 2);
            $table->bigInteger('cantidad');
            $table->string('unidad');
            $table->bigInteger('cantidad_inicial')->nullable();
            $table->unsignedBigInteger('id_proveedor')->nullable();
            $table->unsignedBigInteger('id_categoria')->nullable();
            $table->unsignedBigInteger('id_sucursal')->nullable();
            $table->string('ruta_foto')->nullable();
            $table->string('foto')->nullable();

            $table->foreign('id_proveedor')
            ->references('id')
            ->on('proveedors')
            ->onDelete('cascade');

            $table->foreign('id_categoria')
            ->references('id')
            ->on('categorias')
            ->onDelete('cascade');

            $table->foreign('id_sucursal')
            ->references('id')
            ->on('sucursals')
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
        Schema::dropIfExists('productos');
    }
}
