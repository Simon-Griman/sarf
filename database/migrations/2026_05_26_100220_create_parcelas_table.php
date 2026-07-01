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
            $table->foreignId('producto_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('volumen')->nullable();
            $table->enum('cantidad_determinada', ['Tanque de Tierra', 'Cifras Buque'])->nullable();

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
            $table->decimal('agua_sedimento', 6, 3);
            $table->decimal('azufre', 8, 2);

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
            $table->decimal('ROB', 8, 2)->nullable();
            $table->decimal('ROB_agua', 8, 2)->nullable();
            $table->decimal('TCV_descarga', 8, 2)->nullable();
            $table->decimal('GSV_descarga', 8, 2)->nullable();
            $table->decimal('NSV_descarga', 8, 2)->nullable();
            $table->decimal('TDV', 8, 2)->nullable();
            $table->decimal('TDV_ajustado', 8, 2)->nullable();

            $table->decimal('VEF', 6, 4)->nullable();

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
