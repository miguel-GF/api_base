<?php

namespace App\Http\Services\BO;

use Illuminate\Support\Str;
use App\Herramientas;
use stdClass;

class UsuarioBO
{
    
    public static function makeDataUser(object $user)
    {
        try {

            $res = new stdClass();

            $res->usuario_id = $user->usuario_id;
            $res->usuario    = $user->usuario;
            $res->tipo       = $user->tipo;
            $res->token      = str_shuffle(substr(Str::uuid(), 0, 17) . Str::random(18));
            return $res;
            
        } 
        catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }

    }

    public static function armarUpdateLogin(object $user)
    {
        try {

            $update = [];

            $update['last_login'] = Herramientas::fechaActual(); 
            $update['tkn']        = md5($user->token);

            return $update;
            
        } 
        catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }

    }

    public static function armarLogOut()
    {
        try {

            $update = [];

            $update['tkn']        = null;

            return $update;
            
        } 
        catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }

    }
}