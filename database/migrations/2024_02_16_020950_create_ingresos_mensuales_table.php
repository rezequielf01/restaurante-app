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
        Schema::create('ingreso_mensuals', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('año');
            $table->unsignedTinyInteger('mes');
            $table->decimal('ingreso_total', 10, 3); // Cambia el tipo de dato y la precisión según tus necesidades
            $table->timestamps(); // Si deseas tener timestamps en tu tabla, como created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos_mensuales');
    }
};
