<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            
          $table->bigIncrements('id');
           $table->bigInteger('nit');
           $table->string('nombre_empresa');
           $table->string('nombre_contacto');
          $table->string('direccion');
           $table->string('telefono');
           $table->string('email');
          $table->string('web_site');
           $table->string('categoria');     
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
        Schema::dropIfExists('proveedors');
    }
}