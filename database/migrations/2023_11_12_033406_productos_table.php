<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->decimal('stock');
            $table->decimal('precio_unitario', 10, 2);
            $table->string('categoria');
            $table->timestamps();
        });
        
    }
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
