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
        Schema::create('cocinero', function (Blueprint $table) {
            $table->id('id_cocinero');
            $table->foreignId('id')->constrained('users')->onDelete('cascade');
            $table->string('nombre', 50);
            $table->string('apellido', 25);
            $table->string('especialidad', 20)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cocinero');
    }
};
