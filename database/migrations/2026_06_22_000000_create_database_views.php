<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Vista 1: Estadísticas de Equipos
        DB::statement("
            CREATE OR REPLACE VIEW v_estadisticas_equipos AS
            SELECT
                e.id,
                e.nombre,
                e.estado,
                COUNT(DISTINCT j.id) as total_jugadores,
                COUNT(DISTINCT ent.id) as total_entrenamientos,
                COUNT(DISTINCT p.id) as total_partidos,
                u.name as entrenador,
                e.cuota,
                e.created_at
            FROM equipos e
            LEFT JOIN jugadores j ON e.id = j.equipo_id
            LEFT JOIN entrenamientos ent ON e.id = ent.equipo_id
            LEFT JOIN partidos p ON e.id = p.equipo_id
            LEFT JOIN users u ON e.coach_id = u.id
            GROUP BY e.id, e.nombre, e.estado, u.name, e.cuota, e.created_at
        ");

        // Vista 2: Listado de Jugadores con Equipo
        DB::statement("
            CREATE OR REPLACE VIEW v_jugadores_por_equipo AS
            SELECT
                j.id,
                j.nombre,
                j.apellido,
                j.email,
                j.numero_camiseta,
                j.posicion,
                j.fecha_nacimiento,
                e.nombre as equipo,
                e.id as equipo_id,
                e.estado as estado_equipo
            FROM jugadores j
            LEFT JOIN equipos e ON j.equipo_id = e.id
            ORDER BY e.nombre, j.apellido
        ");

        // Vista 3: Pagos Pendientes
        DB::statement("
            CREATE OR REPLACE VIEW v_pagos_pendientes AS
            SELECT
                pa.id,
                j.nombre,
                j.apellido,
                e.nombre as equipo,
                pa.concepto,
                pa.importe,
                pa.fecha_pago,
                pa.estado,
                pa.created_at
            FROM pagos pa
            LEFT JOIN jugadores j ON pa.jugador_id = j.id
            LEFT JOIN equipos e ON pa.equipo_id = e.id
            WHERE pa.estado IN ('pendiente', 'sin_pagar')
            ORDER BY pa.created_at DESC
        ");

        // Vista 4: Entrenamientos Próximos
        DB::statement("
            CREATE OR REPLACE VIEW v_entrenamientos_proximos AS
            SELECT
                ent.id,
                e.nombre as equipo,
                ent.fecha,
                ent.hora_inicio,
                ent.hora_fin,
                ent.tipo,
                ent.lugar,
                ent.descripcion,
                ent.duracion_minutos
            FROM entrenamientos ent
            LEFT JOIN equipos e ON ent.equipo_id = e.id
            WHERE ent.fecha >= CURDATE()
            ORDER BY ent.fecha, ent.hora_inicio
        ");

        // Vista 5: Partidos con Resultados
        DB::statement("
            CREATE OR REPLACE VIEW v_partidos_resultados AS
            SELECT
                p.id,
                e.nombre as equipo,
                p.rival,
                p.fecha,
                p.hora,
                p.lugar,
                p.tipo_ubicacion,
                p.goles_favor,
                p.goles_contra,
                p.estado,
                CASE
                    WHEN p.goles_favor > p.goles_contra THEN 'Ganado'
                    WHEN p.goles_favor < p.goles_contra THEN 'Perdido'
                    WHEN p.goles_favor = p.goles_contra THEN 'Empate'
                    ELSE 'Por jugar'
                END as resultado
            FROM partidos p
            LEFT JOIN equipos e ON p.equipo_id = e.id
            ORDER BY p.fecha DESC
        ");

        // Vista 6: Resumen de Usuarios
        DB::statement("
            CREATE OR REPLACE VIEW v_resumen_usuarios AS
            SELECT
                u.id,
                u.name,
                u.email,
                u.role,
                COUNT(DISTINCT e.id) as equipos_creados,
                COUNT(DISTINCT tu.equipo_id) as equipos_miembro,
                u.created_at
            FROM users u
            LEFT JOIN equipos e ON u.id = e.coach_id
            LEFT JOIN team_user tu ON u.id = tu.user_id
            GROUP BY u.id, u.name, u.email, u.role, u.created_at
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS v_estadisticas_equipos");
        DB::statement("DROP VIEW IF EXISTS v_jugadores_por_equipo");
        DB::statement("DROP VIEW IF EXISTS v_pagos_pendientes");
        DB::statement("DROP VIEW IF EXISTS v_entrenamientos_proximos");
        DB::statement("DROP VIEW IF EXISTS v_partidos_resultados");
        DB::statement("DROP VIEW IF EXISTS v_resumen_usuarios");
    }
};
