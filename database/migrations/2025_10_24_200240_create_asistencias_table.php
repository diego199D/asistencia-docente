<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up()
{
    Schema::create('asistencias', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_usuario')->constrained('users')->cascadeOnDelete();
        $table->date('fecha')->default(now());
        $table->time('hora_marcado')->nullable();
        $table->enum('estado', ['Presente', 'Ausente', 'Retraso'])->default('Presente');
        $table->timestamps();
    });
}
};
