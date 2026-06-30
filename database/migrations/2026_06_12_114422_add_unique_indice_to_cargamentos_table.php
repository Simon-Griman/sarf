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
        Schema::table('cargamentos', function (Blueprint $table) {

            //$sql = 'ALTER TABLE cargamentos ADD UNIQUE INDEX cargamentos_ruta_id_active_unique ((IF(deleted_at IS NULL, ruta_id, NULL)))';

            $sql2 = 'ALTER TABLE cargamentos ADD UNIQUE INDEX cargamentos_nro_embarque_active_unique ((IF(deleted_at IS NULL, nro_embarque, NULL)))';

            //DB::statement($sql);
            DB::statement($sql2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cargamentos', function (Blueprint $table) {
            
            //$table->dropIndex('cargamentos_ruta_id_active_unique');
            $table->dropIndex('cargamentos_nro_embarque_active_unique');
        });
    }
};
