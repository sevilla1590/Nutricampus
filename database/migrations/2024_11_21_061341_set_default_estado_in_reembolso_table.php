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
            $table->string('estado')->default('enviado')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reembolso', function (Blueprint $table) {
            $table->string('estado')->default(null)->change(); // Elimina el valor predeterminado
        });
    }
};
