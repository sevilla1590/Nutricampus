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
            // Agregar la columna id_producto después de id_reembolso
            $table->unsignedBigInteger('id_producto')->after('id_reembolso');

            // Configurar la clave foránea con producto.id
            $table->foreign('id_producto')->references('id')->on('producto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reembolso', function (Blueprint $table) {
            // Eliminar clave foránea y columna en caso de rollback
            $table->dropForeign(['id_producto']);
            $table->dropColumn('id_producto');
        });
    }
};
