<?php

namespace App\Http\Services\Data;

use App\Http\Repos\Data\CalificacionRepoData;
use Illuminate\Support\Facades\Log;
use Exception;

class CalificacionServiceData
{
    
    public static function listarCalificaciones(array $datos)
    {
        try {
            
            $calificaciones = CalificacionRepoData::listarCalificaciones($datos);
            
            return $calificaciones;
            
        } 
        catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception("Ocurrió un error al listar calificaciones");
        }

    }
}