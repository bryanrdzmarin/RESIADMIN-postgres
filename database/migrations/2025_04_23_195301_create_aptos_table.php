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
        Schema::create('aptos', function (Blueprint $table) 
        {
            $table->id(); 
            $table->unsignedBigInteger('residencias_id');
            $table->integer('numero')->nullable(false);
            $table->integer('capacidad')->nullable(false);
            $table->string('jefe_apartamento')->nullable(false);
            $table->string('profesor_asignado')->nullable(false);
            $table->string('evaluacion')->nullable();
            
            $table->foreign('residencias_id')
                ->references('id')
                ->on('residencias')
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
        Schema::dropIfExists('aptos');
    }
};
