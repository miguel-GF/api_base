<?php

namespace App\Http\Services\Action;

use App\Http\Repos\Action\UsuarioRepoAction;
use App\Http\Services\Data\UsuarioServiceData;
use App\Http\Services\BO\UsuarioBO;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use stdClass;

class UsuarioServiceAction
{
    
    public static function login(array $datos)
    {
        try {

            $usuario = UsuarioServiceData::obtenerUsuarioLogin($datos);
            $res = new stdClass();
            
            if(empty($usuario) || $usuario == null) {
                $res->mensaje = "Usuario no existe";
                $res->status = 300;
                $res->usuario = null;
            }                
            else if($usuario->password != md5($datos['password'])) {
                $res->mensaje = "Las credenciales son incorrectas";
                $res->status = 301;
                $res->usuario = null;
            }
            else {
                $res->mensaje = "Correcto";
                $res->status = 200;
                $user = UsuarioBO::makeDataUser($usuario);
                self::actualizarUsuarioLogin($user);
                $res->token = $user->token;
                unset($user->token);
                $res->usuario = $user;
            }
                           
            return $res;
            
        } 
        catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }

    }

    public static function actualizarUsuarioLogin(stdClass $user)
    {
        try {

            DB::beginTransaction();

            $update = UsuarioBO::armarUpdateLogin($user);
            UsuarioRepoAction::actualizarUsuario($update, $user->usuario_id);

            DB::commit();
            
        } 
        catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }

    }
}