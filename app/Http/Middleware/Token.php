<?php

namespace App\Http\Middleware;

use App\Http\Repos\Data\UsuarioRepoData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Closure;
use Exception;
use stdClass;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {

            Log::info('midleware token');
            Log::info($request->header('token'));
            
            $res = UsuarioRepoData::checarToken(['token' => $request->header('token')]);

            if (!$res) {
                $respuesta = new stdClass();
                $respuesta->status = 600;
                $respuesta->mensaje = "Token a expirado";
                return response(json_encode($respuesta));
            } 
            // else if ($res) {
            //     $update = UsuarioBO::armarLogOut();
            //     return UsuarioRepoAction::actualizarUsuario($update, $res->usuario_id);
            // }
            
            return $next($request);
        } 
        catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }
    }
}
