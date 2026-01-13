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
        Schema::create('becados_extranjeros', function (Blueprint $table) {
            $table->string('numero_pasaporte',11) ->primary();
            $table->string('pais');
            $table-> string('direccion_embajada');
            $table->integer('year_entrada');
            $table->string('evaluacion_jefe_relaciones_internacionales')->nullable();
            $table->string('becados_ci',11)->nullable();
           
           
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
        Schema::dropIfExists('becados_extranjeros');
    }
};
