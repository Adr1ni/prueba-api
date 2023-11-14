<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id(); 
            $table->string('nombre_empresa');
            $table->string('ruc')->unique();
            $table->string('direccion');
            $table->string('telefono');
            $table->string('correo_electronico')->nullable();
            $table->string('contacto')->nullable();
            $table->date('fecha_registro');
            $table->boolean('activa')->default(true);
            $table->timestamps(); // Campos de marcas de tiempo para "created_at" y "updated_at".
        });
    }

    public function down()
    {
        Schema::dropIfExists('empresas');
    }
};
