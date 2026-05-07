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
        Schema::create('respaldo_borrados', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('role')->nullable();
            $table->integer('peso')->nullable();

            $table->timestamp('deleted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respaldo_borrados');
    }
};
