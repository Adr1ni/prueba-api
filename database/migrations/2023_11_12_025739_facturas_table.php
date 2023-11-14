<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->refences('id')->on('empresas')->onDelete('cascade');
            $table->date('fecha_emision');
            $table->date('fecha_vencimiento');
            $table->string('moneda');
            $table->string('condicion_pago');
            $table->text('observacion')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('facturas');
    }
};
