<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('resumens', function (Blueprint $table) {
            
            $table->dropUnique(['nro_viaje']);

            $sql = 'ALTER TABLE resumens ADD UNIQUE INDEX resumens_nro_viaje_active_unique ((IF(deleted_at IS NULL, nro_viaje, NULL)))';

            DB::statement($sql);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resumens', function (Blueprint $table) {
            
            $table->dropIndex('resumens_nro_viaje_active_unique');
            $table->unique('nro_viaje');
        });
    }
};
