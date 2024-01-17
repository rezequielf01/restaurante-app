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
            $table->string("cliente");
            $table->text("telefono",10)->nullable();
            $table->string("direccion",100);
            $table->text("pedido");
            $table->string("metodo_de_pago");
            $table->string("envio");
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
