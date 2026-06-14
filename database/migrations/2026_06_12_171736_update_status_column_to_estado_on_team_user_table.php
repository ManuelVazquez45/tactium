<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Renombramos la columna
        Schema::table('team_user', function (Blueprint $table) {
            $table->renameColumn('status', 'estado');
        });

        // 2. Actualizamos los valores existentes (mapeo de datos)
        // Asumiendo que usabas 'pending', 'approved', 'denied' en inglés
        DB::table('team_user')->where('estado', 'pending')->update(['estado' => 'pendiente']);
        DB::table('team_user')->where('estado', 'approved')->update(['estado' => 'aprobado']);
        DB::table('team_user')->where('estado', 'denied')->update(['estado' => 'denegado']);
    }

    public function down(): void
    {
        // Revertimos el proceso en caso de rollback
        Schema::table('team_user', function (Blueprint $table) {
            $table->renameColumn('estado', 'status');
        });

        DB::table('team_user')->where('estado', 'pendiente')->update(['estado' => 'pending']);
        // ... añadir resto de reversiones si es necesario
    }
};
