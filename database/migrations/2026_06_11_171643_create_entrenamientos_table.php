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
        Schema::create('entrenamientos', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla equipos (Foreign Key)
            // Asegúrate de que la tabla 'equipos' ya esté migrada antes de ejecutar esta
            $table->foreignId('equipo_id')->constrained('equipos')->onDelete('cascade');

            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('tipo')->nullable(); // Ej: Táctico, Físico, Técnico
            $table->string('lugar')->nullable(); // Ej: Campo 1, Gimnasio
            $table->text('descripcion')->nullable();
            $table->text('notas')->nullable();
            $table->integer('duracion_minutos')->nullable();

            $table->timestamps(); // Crea 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrenamientos');
    }
};
