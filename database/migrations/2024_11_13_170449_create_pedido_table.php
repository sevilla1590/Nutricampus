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
        Schema::create('pedido', function (Blueprint $table) {
            $table->id(); // ID principal
            
            // Relación con método de pago
            $table->unsignedBigInteger('id_metodo_pago')->nullable();
            $table->foreign('id_metodo_pago')->references('id')->on('metodo_pago')->onDelete('set null');
            
            // Relación con cliente
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente')->onDelete('set null');
            
            // Relación con administrador
            $table->unsignedBigInteger('id_administrador')->nullable();
            $table->foreign('id_administrador')->references('id_administrador')->on('administrador')->onDelete('set null');
            
            // Relación con repartidor
            $table->unsignedBigInteger('id_repartidor')->nullable();
            $table->foreign('id_repartidor')->references('id_repartidor')->on('repartidor')->onDelete('set null');
            
            // Relación con cocinero
            $table->unsignedBigInteger('id_cocinero')->nullable();
            $table->foreign('id_cocinero')->references('id_cocinero')->on('cocinero')->onDelete('set null');
            
            // Otros campos
            $table->dateTime('fecha'); // Fecha del pedido
            $table->decimal('total', 10, 2); // Total del pedido
            $table->string('estado_pago', 25); // Estado del pago
            $table->string('estado', 25); // Estado del pedido
            $table->string('nro_transaccion', 25); // Número de transacción
            $table->timestamps(); // Timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido'); // Elimina la tabla si existe
    }
};
