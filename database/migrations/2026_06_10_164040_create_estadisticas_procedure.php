<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Los procedimientos solo se crean en MySQL, no en SQLite (tests)
        if (DB::getDriverName() !== 'sqlite') {
            $procedure = "
                DROP PROCEDURE IF EXISTS ObtenerResumenEquipo;
                CREATE PROCEDURE ObtenerResumenEquipo(IN equipo_id_param INT)
                BEGIN
                    SELECT
                        e.id,
                        e.nombre,
                        (SELECT COUNT(*) FROM entrenamientos WHERE equipo_id = equipo_id_param) AS total_entrenamientos,
                        (SELECT IFNULL(SUM(duracion_minutos), 0) FROM entrenamientos WHERE equipo_id = equipo_id_param) AS minutos_totales
                    FROM equipos e
                    WHERE e.id = equipo_id_param;
                END;
            ";
            DB::unprepared($procedure);
        }
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ObtenerResumenEquipo");
    }
};
