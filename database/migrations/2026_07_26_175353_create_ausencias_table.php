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
        Schema::create('ausencias', function (Blueprint $table) {
            $table->id('idAusencias');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->enum('tipoAusencias', ['Vacaciones', 'Enfermedad', 'Permiso', 'Otros']);
            $table->enum('estadoAusencias', ['Aprobado','Rechazado', 'Pendiente'])->default('Pendiente');
            $table->text('observacionesAusencias')->nullable();
            $table->integer('empleadoid')->references('idEmpleados')->on('empleados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ausencias');
    }
};
