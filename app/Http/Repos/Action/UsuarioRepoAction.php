<?php

namespace App\Http\Repos\Action;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class UsuarioRepoAction
{   
    public static function actualizarUsuario(array $datos, string $usuarioId)
    {
        try {

            DB::table('usuarios')
                ->where('usuario_id', '=', $usuarioId)
                ->update($datos);
        } 
        catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }

    }
}