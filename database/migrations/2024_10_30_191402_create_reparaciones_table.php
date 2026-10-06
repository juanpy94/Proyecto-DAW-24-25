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
        Schema::create('reparaciones', function (Blueprint $table) {
            $table->id();

            $table->enum('estado', ['asignado', 'en proceso', 'completado']);
            $table->date('fecha_entrada');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->text('descripcion');
            $table->foreignId('id_usuario')->nullable()->constrained('usuarios')->nullOnDelete();
            $table->foreignId('id_vehiculo_maquina')->constrained('vehiculos_maquinarias');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reparaciones');
    }
};
