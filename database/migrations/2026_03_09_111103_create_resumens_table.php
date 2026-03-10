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
        Schema::create('resumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('terminal_origen_id')->constrained()->onDelete('cascade');
            $table->foreignId('terminal_destino_id')->constrained()->onDelete('cascade');
            $table->string('buque', 45);
            $table->bigInteger('nro_embarque'); //12 digitos
            $table->bigInteger('nro_viaje')->unique();
            $table->foreignId('operacion_id')->constrained()->onDelete('cascade');
            $table->foreignId('producto_id')->constrained()->onDelete('cascade');
            $table->integer('volumen');
            $table->enum('cantidad_determinada', ['Tanque de Tierra', 'Cifras Buque']);
            $table->enum('documento', ['Borrador', 'Definitivo']);

            //datos tierra
            $table->decimal('TOV', 8, 2);
            $table->decimal('GOV', 8, 2);
            $table->decimal('GSV', 8, 2);
            $table->decimal('NSV', 8, 2);
            $table->decimal('TCV', 8, 2);
            $table->decimal('sediment_water', 6, 2);
            $table->decimal('free_water', 6, 2);

            //detalles tierra
            $table->string('tabla_VCF', 45);
            $table->integer('temp');
            $table->integer('API');

            //datos buque
            //carga
            $table->integer('OBQ')->nullable();
            $table->integer('OBQ_agua')->nullable();
            $table->integer('TCV_carga')->nullable();
            $table->integer('GSV_carga')->nullable();
            $table->integer('NSV_carga')->nullable();
            $table->integer('TRV')->nullable();
            $table->integer('TRV_ajustado')->nullable();
            //descarga
            $table->integer('ROB')->nullable();
            $table->integer('ROB_agua')->nullable();
            $table->integer('TCV_descarga')->nullable();
            $table->integer('GSV_descarga')->nullable();
            $table->integer('NSV_descarga')->nullable();
            $table->integer('TDV')->nullable();
            $table->integer('TDV_ajustado')->nullable();

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
        Schema::dropIfExists('resumens');
    }
};
