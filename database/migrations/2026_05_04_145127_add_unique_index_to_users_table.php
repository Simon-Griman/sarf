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
        Schema::table('users', function (Blueprint $table) {
            // Eliminamos el índice anterior
            $table->dropUnique(['email']);

            // Creamos un índice funcional
            // Si deleted_at es NULL, el índice usa el email. 
            // Si NO es NULL (está borrado), el índice se vuelve NULL y MySQL ignora la restricción.
            $sql = 'ALTER TABLE users ADD UNIQUE INDEX users_email_active_unique ((IF(deleted_at IS NULL, email, NULL)))';
            DB::statement($sql);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Eliminamos el índice funcional que creamos con el SQL crudo
            // Nota: MySQL usa el nombre que le dimos en el statement: 'users_email_active_unique'
            $table->dropIndex('users_email_active_unique');

            // 2. Restauramos el índice único original de Laravel
            $table->unique('email');
        });
    }
};
