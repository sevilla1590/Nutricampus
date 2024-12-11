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
        Schema::table('cliente', function (Blueprint $table) {
            $table->string('estado')->default('activo'); // Campo para manejar el estado del cliente
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('cliente', function (Blueprint $table) {
            if (Schema::hasColumn('cliente', 'estado')) {
                $table->dropColumn('estado');
            }
        });
    }
};
