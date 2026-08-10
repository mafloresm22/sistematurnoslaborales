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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('idEmpleados');
            $table->string('nombreEmpleados', 150)->nullable(false);
            $table->string('apellidoEmpleados', 150)->nullable(false);
            $table->enum('tipodocumentoEmpleados', ['DNI', 'CI', 'RUC', 'CE', 'Pasaporte', 'Otro'])->nullable(false);
            $table->string('numerodocumentoEmpleados', 150)->nullable(false);
            $table->string('telefonoEmpleados', 150)->nullable(false);
            $table->text('direccionEmpleados')->nullable(false);
            $table->string('profesionEmpleados', 150)->nullable(false);
            $table->date('fechanacimientoEmpleados')->nullable(true);
            $table->enum('sexoEmpleados', ['Masculino', 'Femenino', 'Otros'])->nullable(false);
            $table->string('avatarEmpleados', 250)->nullable(true);
            $table->enum('estadoEmpleados', ['Activo', 'Inactivo', 'Suspendido'])->nullable(false)->default('Activo');
            $table->unsignedBigInteger('usuarioid')->nullable(true);
            $table->foreign('usuarioid')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
