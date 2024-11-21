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
        Schema::table('pedido', function (Blueprint $table) {
             // Añadir columna id_producto con clave foránea
             $table->unsignedBigInteger('id_producto')->after('id'); // Añade el campo después del id
             $table->foreign('id_producto')->references('id')->on('producto')->onDelete('cascade');
 
             // Añadir columna nro_transaccion
             $table->string('nro_transaccion')->nullable()->after('estado'); // Añade nro_transaccion después de estado
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedido', function (Blueprint $table) {
            // Eliminar la clave foránea y la columna id_producto
            $table->dropForeign(['id_producto']);
            $table->dropColumn('id_producto');

            // Eliminar la columna nro_transaccion
            $table->dropColumn('nro_transaccion');
        });
    }
};
