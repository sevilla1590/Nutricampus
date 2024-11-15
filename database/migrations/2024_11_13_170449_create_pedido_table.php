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
            $table->id();
            $table->foreignId('id_metodo_pago')->constrained('metodo_pago')->onDelete('cascade');
            $table->foreignId('id_cliente')->constrained('cliente')->onDelete('cascade');
            $table->foreignId('id_administrador')->nullable()->constrained('administrador')->onDelete('set null');
            $table->foreignId('id_repartidor')->nullable()->constrained('repartidor')->onDelete('set null');
            $table->foreignId('id_cocinero')->nullable()->constrained('cocinero')->onDelete('set null');
            $table->dateTime('fecha');
            $table->decimal('total', 10, 2);
            $table->string('estado_pago', 25);
            $table->string('estado', 25);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido');
    }
};
