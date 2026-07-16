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
        Schema::table('parcelas', function (Blueprint $table) {
            // Datos tierra
            $table->decimal('TOV', 10, 2)->change();
            $table->decimal('GOV', 10, 2)->change();
            $table->decimal('GSV', 10, 2)->change();
            $table->decimal('NSV', 10, 2)->change();
            $table->decimal('TCV', 10, 2)->change();
            $table->decimal('sediment_water', 10, 2)->change();
            $table->decimal('free_water', 10, 2)->change();

            // Detalles tierra
            $table->decimal('temp', 12, 2)->change();
            $table->decimal('API', 12, 2)->change();
            $table->decimal('agua_sedimento', 10, 2)->change();
            $table->decimal('azufre', 12, 2)->change();

            // Datos buque - Carga
            $table->decimal('OBQ', 10, 2)->nullable()->change();
            $table->decimal('OBQ_agua', 10, 2)->nullable()->change();
            $table->decimal('TCV_carga', 10, 2)->nullable()->change();
            $table->decimal('GSV_carga', 10, 2)->nullable()->change();
            $table->decimal('NSV_carga', 10, 2)->nullable()->change();
            $table->decimal('TRV', 10, 2)->nullable()->change();
            $table->decimal('TRV_ajustado', 10, 2)->nullable()->change();
            
            // Descarga
            $table->decimal('ROB', 10, 2)->nullable()->change();
            $table->decimal('ROB_agua', 10, 2)->nullable()->change();
            $table->decimal('TCV_descarga', 10, 2)->nullable()->change();
            $table->decimal('GSV_descarga', 10, 2)->nullable()->change();
            $table->decimal('NSV_descarga', 10, 2)->nullable()->change();
            $table->decimal('TDV', 10, 2)->nullable()->change();
            $table->decimal('TDV_ajustado', 10, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcelas', function (Blueprint $table) {
            // Datos tierra
            $table->decimal('TOV', 8, 2)->change();
            $table->decimal('GOV', 8, 2)->change();
            $table->decimal('GSV', 8, 2)->change();
            $table->decimal('NSV', 8, 2)->change();
            $table->decimal('TCV', 8, 2)->change();
            $table->decimal('sediment_water', 6, 2)->change();
            $table->decimal('free_water', 6, 2)->change();

            // Detalles tierra
            $table->decimal('temp', 8, 1)->change();
            $table->decimal('API', 8, 1)->change();
            $table->decimal('agua_sedimento', 6, 3)->change();
            $table->decimal('azufre', 8, 2)->change();

            // Datos buque - Carga
            $table->decimal('OBQ', 8, 2)->nullable()->change();
            $table->decimal('OBQ_agua', 8, 2)->nullable()->change();
            $table->decimal('TCV_carga', 8, 2)->nullable()->change();
            $table->decimal('GSV_carga', 8, 2)->nullable()->change();
            $table->decimal('NSV_carga', 8, 2)->nullable()->change();
            $table->decimal('TRV', 8, 2)->nullable()->change();
            $table->decimal('TRV_ajustado', 8, 2)->nullable()->change();
            
            // Descarga
            $table->decimal('ROB', 8, 2)->nullable()->change();
            $table->decimal('ROB_agua', 8, 2)->nullable()->change();
            $table->decimal('TCV_descarga', 8, 2)->nullable()->change();
            $table->decimal('GSV_descarga', 8, 2)->nullable()->change();
            $table->decimal('NSV_descarga', 8, 2)->nullable()->change();
            $table->decimal('TDV', 8, 2)->nullable()->change();
            $table->decimal('TDV_ajustado', 8, 2)->nullable()->change();
        });
    }
};
