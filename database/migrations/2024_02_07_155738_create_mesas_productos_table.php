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
        Schema::create('mesas_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mesas_id');
            $table->unsignedBigInteger('productos_id');
            // $table->foreignId('mesas_id')->constrained();
            // $table->foreignId('productos_id')->constrained();
            $table->integer('producto_cantidad')->nullable();
            $table->timestamps();

            $table->foreign('mesas_id')
                ->references('id')->on('mesas')
                ->onDelete('cascade')
                ->onUpdate('no action');
                
            $table->foreign('productos_id')
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
        Schema::dropIfExists('mesas_productos');
    }
};
