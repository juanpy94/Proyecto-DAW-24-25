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
        Schema::create('vehiculos_maquinarias', function (Blueprint $table) {
            $table->id();

            $table->string('marca');
            $table->string('modelo')->nullable();
            $table->string('matricula')->nullable();
            $table->integer('ano')->nullable();
            $table->foreignId('id_categoria')->constrained('categorias');
            $table->foreignId('id_usuario')->nullable()->constrained('usuarios')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos_maquinarias');
    }
};
