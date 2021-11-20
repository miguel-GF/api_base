<?php

namespace App\Http\Repos\Data;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class CalificacionRepoData
{
    
    public static function listarCalificaciones(array $datos)
    {
        try {
            
            $query = DB::table('calificaciones AS c')
                ->select(
                    'c.calificacion_id',
                    'c.usuario_id',
                    'c.nombre_materia',
                    'c.calificacion',
                    'c.fecha',
                    'u.usuario AS nombre_usuario'
                )
                ->leftJoin('usuarios AS u', 'u.usuario_id', '=', 'c.usuario_id')
                ->where('u.usuario_id', '=', $datos['usuarioId']);
            
            $calificaciones = $query->get()->toArray();
            
            return $calificaciones ?: [];
            
        } 
        catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception("");
        }

    }
}