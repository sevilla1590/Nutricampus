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
        Schema::create('administrador', function (Blueprint $table) {
            $table->id('id_administrador');
            $table->foreignId('id')->constrained('users')->onDelete('cascade');
            $table->string('nombre', 25);
            $table->string('apellido', 25);
            $table->string('horario', 20);
            $table->string('certificado', 50)->nullable();
            $table->string('corte_ventas', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrador');
    }
};
