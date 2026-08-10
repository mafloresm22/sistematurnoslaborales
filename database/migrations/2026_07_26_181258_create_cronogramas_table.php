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
        Schema::create('cronogramas', function (Blueprint $table) {
            $table->id('idCronograma');
            $table->integer('empleadoid')->references('idEmpleados')->on('empleados')->onDelete('cascade');
            $table->integer('sucursalesid')->references('idSucursales')->on('sucursales')->onDelete('cascade');
            $table->integer('turnoid')->references('idTurno')->on('turnos')->onDelete('cascade');
            $table->date('fechaCronograma');
            $table->text('notaCronograma')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cronogramas');
    }
};
