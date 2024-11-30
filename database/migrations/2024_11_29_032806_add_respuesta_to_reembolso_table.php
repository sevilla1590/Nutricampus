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
        Schema::table('reembolso', function (Blueprint $table) {
            $table->text('respuesta')->nullable(); // Agregar la columna respuesta (tipo texto, y puede ser nula)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reembolso', function (Blueprint $table) {
            $table->dropColumn('respuesta'); // Eliminar la columna si la migración se revierte
        });
    }
};
