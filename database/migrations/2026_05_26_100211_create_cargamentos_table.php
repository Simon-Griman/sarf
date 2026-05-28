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
        Schema::create('cargamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('terminal_origen_id')->constrained()->onDelete('cascade');
            // $table->foreignId('terminal_destino_id')->constrained()->onDelete('cascade'); // muchos a muchos con terminales
            $table->string('buque', 45);
            $table->bigInteger('nro_embarque'); //12 digitos
            $table->date('fecha_operacion');
            $table->bigInteger('nro_ruta')->unique();
            $table->foreignId('operacion_id')->constrained()->onDelete('cascade');
            $table->foreignId('inspector_id')->constrained()->onDelete('cascade');
            $table->enum('cantidad_determinada', ['Tanque de Tierra', 'Cifras Buque']);

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
        Schema::dropIfExists('cargamentos');
    }
};
