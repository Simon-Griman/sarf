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
        Schema::table('respaldo_borrados', function (Blueprint $table) {
            $table->unsignedBigInteger('terminal_destino_id')->nullable()->after('peso');
            $table->string('terminal_destino')->nullable()->after('terminal_destino_id');

            $table->unsignedBigInteger('terminal_origen_id')->nullable()->after('terminal_destino');
            $table->string('terminal_origen')->nullable()->after('terminal_origen_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('respaldo_borrados', function (Blueprint $table) {
            $table->dropColumn('terminal_destino_id');
            $table->dropColumn('terminal_destino');

            $table->dropColumn('terminal_origen_id');
            $table->dropColumn('terminal_origen');
        });
    }
};
