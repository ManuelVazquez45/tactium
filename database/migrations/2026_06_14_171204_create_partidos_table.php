<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained('equipos')->onDelete('cascade');
            $table->date('fecha');
            $table->time('hora')->nullable();
            $table->string('rival');
            $table->string('lugar')->nullable();
            $table->enum('tipo_ubicacion', ['local', 'visitante'])->default('local');
            $table->integer('goles_favor')->nullable();
            $table->integer('goles_contra')->nullable();
            $table->enum('estado', ['programado', 'jugado', 'cancelado'])->default('programado');
            $table->text('descripcion')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
