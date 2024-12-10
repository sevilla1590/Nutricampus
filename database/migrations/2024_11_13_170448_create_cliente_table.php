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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->foreignId('id')->constrained('users')->onDelete('cascade');
            $table->string('nombre', 25);
            $table->string('apellido', 25);
            $table->string('direccion', 50)->nullable();
            $table->string('preferencias', 100)->nullable();
            $table->string('observaciones', 100)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
