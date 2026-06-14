<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Primero aumentar el tamaño de la columna
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 50)->change();
        });

        // Luego actualizar los valores
        DB::table('users')->where('role', 'coach')->update(['role' => 'entrenador']);
    }

    public function down(): void
    {
        DB::table('users')->where('role', 'entrenador')->update(['role' => 'coach']);

        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 10)->change();
        });
    }
};
