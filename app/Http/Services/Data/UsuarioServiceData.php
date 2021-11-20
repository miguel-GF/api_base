<?php

namespace App\Http\Services\Data;

use App\Http\Repos\Data\UsuarioRepoData;
use Illuminate\Support\Facades\Log;
use Exception;

class UsuarioServiceData
{
    
    public static function obtenerUsuarioLogin(array $datos)
    {
        try {

            $usuario = UsuarioRepoData::obtenerUsuarioLogin($datos);
            
            return $usuario;
            
        } 
        catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception("Ocurrió un error al iniciar sesión");
        }

    }
}