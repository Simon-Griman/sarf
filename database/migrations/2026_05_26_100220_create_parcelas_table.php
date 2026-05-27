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
        Schema::create('parcelas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cargamento_id')->constrained()->onDelete('cascade');
            $table->foreignId('producto_id')->constrained()->onDelete('cascade');
            $table->integer('volumen');

            //datos tierra
            $table->decimal('TOV', 8, 2);
            $table->decimal('GOV', 8, 2);
            $table->decimal('GSV', 8, 2);
            $table->decimal('NSV', 8, 2);
            $table->decimal('TCV', 8, 2);
            $table->decimal('sediment_water', 6, 2);
            $table->decimal('free_water', 6, 2);

            //detalles tierra
            $table->decimal('temp', 8, 1);
            $table->decimal('API', 8, 1);
            $table->decimal('agua_sedimento', 6, 2);
            $table->decimal('azufre', 8, 3);

            //datos buque
            //carga
            $table->decimal('OBQ', 8, 2)->nullable();
            $table->decimal('OBQ_agua', 8, 2)->nullable();
            $table->decimal('TCV_carga', 8, 2)->nullable();
            $table->decimal('GSV_carga', 8, 2)->nullable();
            $table->decimal('NSV_carga', 8, 2)->nullable();
            $table->decimal('TRV', 8, 2)->nullable();
            $table->decimal('TRV_ajustado', 8, 2)->nullable();
            //descarga
            $table->integer('ROB')->nullable();
            $table->integer('ROB_agua')->nullable();
            $table->integer('TCV_descarga')->nullable();
            $table->integer('GSV_descarga')->nullable();
            $table->integer('NSV_descarga')->nullable();
            $table->integer('TDV')->nullable();
            $table->integer('TDV_ajustado')->nullable();

            $table->decimal('VEF', 6, 4)->nullable();

            //documentos
            $table->string('nominacion')->nullable();
            $table->string('embarque')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('calidad')->nullable();
            $table->string('hoja_tiempo')->nullable();
            $table->string('acta')->nullable();
            $table->string('ullage_inicial')->nullable();
            $table->string('ullage_final')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcelas');
    }
};
