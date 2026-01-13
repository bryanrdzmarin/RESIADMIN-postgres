<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up(): void
        {
            Schema::create('becados', function (Blueprint $table) {
            $table->string('ci', 11)->primary();
            $table->string('nombre')->nullable(false);
            $table->date('fecha_nacimiento')->nullable(false);
            $table->string('year_carrera')->nullable(false);
            $table->string('carrera')->nullable(false);
            $table->string('origen')->nullable(false);
            
            $table->integer('evaluacion_jefe_residencia')->nullable();
            $table->integer('evaluacion_jefe_apto')->nullable();
            $table->integer('evaluacion_profesor')->nullable();
            $table->string('evaluacion_final')->nullable(); 

            $table->unsignedBigInteger('residencias_id')->nullable();
            $table->unsignedBigInteger('aptos_id')->nullable();

            
            // Clave foránea corregida
            $table->foreign('aptos_id')
                ->references('id')
                ->on('aptos')
                ->onDelete('cascade') 
                ->onUpdate('cascade');

            $table->timestamps();
        });


        DB::statement("ALTER TABLE becados ADD CONSTRAINT chk_evaluacion_jefe_residencia CHECK (evaluacion_jefe_residencia BETWEEN 1 AND 5)");
        DB::statement("ALTER TABLE becados ADD CONSTRAINT chk_evaluacion_jefe_apto CHECK (evaluacion_jefe_apto BETWEEN 1 AND 5)");
        DB::statement("ALTER TABLE becados ADD CONSTRAINT chk_evaluacion_profesor CHECK (evaluacion_profesor BETWEEN 1 AND 5)");
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('becados');
    }
};
