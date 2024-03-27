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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('producto_id')->nullable();
            $table->string('nombre');
            $table->integer('cantidad');
            $table->string('precio');
            $table->timestamps(); 

            $table->foreign('pedido_id')
                ->references('id')->on('pedidos')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('producto_id')
            ->references('id')->on('productos')
            ->onDelete('set null')
            ->onUpdate('no action');

        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
