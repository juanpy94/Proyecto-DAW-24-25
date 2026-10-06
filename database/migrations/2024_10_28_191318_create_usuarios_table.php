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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('usuario')->unique();
            $table->string('password');
            $table->string('telefono');
            $table->enum('rol', ['administrador', 'cliente', 'jefe_taller', 'mecanico', 'administrativo']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
