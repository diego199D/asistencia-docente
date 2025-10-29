<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // quien inicio sesion
            $table->string('ip_address')->nullable(); // IP del usuario
            $table->timestamp('fecha_hora'); // fecha y hora exacta
            $table->string('accion')->default('Inicio de sesión'); // tipo de acción
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bitacoras');
    }
};
