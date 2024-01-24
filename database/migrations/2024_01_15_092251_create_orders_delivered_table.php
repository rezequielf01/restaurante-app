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
        Schema::create('pedidos_entregados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            
            $table->foreign('cliente_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->string("direccion");
            $table->string("total");
            $table->timestamp('create_time')->nullable();
            $table->timestamp('update_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
