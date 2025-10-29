<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            $table->string('nro_aula', 10); // ✅ Nombre correcto del aula (coincide con el modelo)
            $table->integer('capacidad')->nullable(); // cantidad de personas
            $table->string('piso', 10)->nullable(); // número o nombre del piso
            $table->boolean('disponible')->default(true); // ✅ NUEVO campo para controlar disponibilidad
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('aulas');
    }
};