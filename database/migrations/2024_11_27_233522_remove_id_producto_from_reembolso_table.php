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
            // Elimina la clave foránea
            $table->dropForeign(['id_producto']);

            // Luego elimina la columna
            $table->dropColumn('id_producto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reembolso', function (Blueprint $table) {
            // Si quieres restaurar la columna en el futuro
            $table->unsignedBigInteger('id_producto')->nullable();

            // Puedes agregar la clave foránea nuevamente
            $table->foreign('id_producto')->references('id')->on('productos')->onDelete('cascade');
        });
    }
};
