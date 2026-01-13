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
        Schema::create('residencias', function (Blueprint $table) {
            $table->id();
            $table-> string('nombre')-> nullable(false);
            $table-> integer('cantidad_aptos')-> nullable(false);
            $table-> string('jefe_consejo_residencia')-> nullable(false);
            $table-> string('profesor_asignado')-> nullable(false);
            $table-> string('evaluacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residencias');
    }
};
