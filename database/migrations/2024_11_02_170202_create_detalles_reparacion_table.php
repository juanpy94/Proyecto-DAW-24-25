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
        Schema::create('detalles_reparacion', function (Blueprint $table) {
            $table->id();

            $table->text('descripcion');
            $table->decimal('cantidad', 10, 2);
            $table->decimal('precio_unidad', 10, 2)->nullable();
            $table->integer('%_iva')->nullable();
            $table->decimal('iva', 10, 2)->nullable();
            $table->integer('%_descuento')->nullable();
            $table->decimal('descuento', 10, 2)->nullable();
            $table->decimal('precio_total', 10, 2)->nullable();
            $table->foreignId('id_reparacion')->constrained('reparaciones');
            $table->foreignId('id_factura')->nullable()->constrained('facturas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_reparacion');
    }
};
