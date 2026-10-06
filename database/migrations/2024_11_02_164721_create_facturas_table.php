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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();

            $table->date('fecha_emision');
            $table->enum('estado', ['pendiente', 'pagada', 'cancelada']);
            $table->decimal('total_factura', 10, 2)->nullable();
            $table->foreignId('id_usuario')->nullable()->constrained('usuarios')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
