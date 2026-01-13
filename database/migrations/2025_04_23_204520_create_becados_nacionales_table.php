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
        Schema::create('becados_nacionales', function (Blueprint $table) {
            $table->string('direccion');
            $table->string('becados_ci',11)->primary();
           
            $table->foreign('becados_ci')
            ->references('ci')
            ->on('becados')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('becados_nacionales');
    }
};
