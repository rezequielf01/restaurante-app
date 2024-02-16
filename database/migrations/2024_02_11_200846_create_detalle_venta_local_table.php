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
        Schema::create('detalle_venta_locals', function (Blueprint $table) {
            $table->id();
            $table->integer('mesa_nro');
            $table->unsignedBigInteger('venta_id');
            $table->unsignedBigInteger('producto_id');
            $table->string('nombre');
            $table->integer('cantidad');
            $table->decimal('precio',10,3);
            $table->timestamps(); 

            $table->foreign('venta_id')
                ->references('id')->on('ventas_locals')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('producto_id')
            ->references('id')->on('productos')
            ->onDelete('cascade')
            ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_venta_local');
    }
};
