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
        Schema::create('reembolso', function (Blueprint $table) {
            $table->id('id_reembolso');
            $table->foreignId('id_cliente')->constrained('cliente')->onDelete('cascade');
            $table->foreignId('id_pedido')->constrained('pedido')->onDelete('cascade');
            $table->dateTime('fecha_reembolso');
            $table->decimal('monto', 10, 2);
            $table->string('motivo', 100)->nullable();
            $table->string('estado', 15)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reembolso');
    }
};
