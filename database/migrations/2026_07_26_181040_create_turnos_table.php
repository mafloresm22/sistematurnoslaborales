<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id('idTurno');
            $table->string('nombreTurnos', 150);
            $table->time('horaInicio');
            $table->time('horaFin');
            $table->string('colorFondo', 10)->default('##2FA7FA');
            $table->string('colorTexto', 10)->default('##F0F0F0');
            $table->integer('categoriaid')->references('idCategorias')->on('categorias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnos');
    }
};
