<?php

namespace App\Http\Repos\Data;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class UsuarioRepoData
{
    
    public static function obtenerUsuarioLogin(array $datos)
    {
        try {
            
            $query = DB::table('usuarios AS u')
                ->select(
                    'u.usuario_id',
                    'u.usuario',
                    'u.password',
                    'u.tipo'
                )
                ->where('u.usuario', '=', $datos['usuario']);
            
            $usuario = $query->get()->first();
            
            return $usuario;
            
        } 
        catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception("");
        }

    }

    public static function checarToken(array $datos)
    {
        try {
            
            $query = DB::table('usuarios AS u')
                ->select(
                    'u.usuario_id',
                    'u.usuario',                    
                    'u.last_login'
                )
                ->where('u.tkn', '=', md5($datos['token']));
            
            $usuario = $query->get()->first();
            
            return $usuario;
            
        } 
        catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception("");
        }

    }
}