<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\Action\UsuarioServiceAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Exception;

class UsuarioController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function login(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'usuario'  => 'required',
                'password' => 'required',
            ]);
    
            if ($validator->fails()) {
                //throw new Exception('error');
            }
    
            $datos = $request->all();
    
            $respuesta = UsuarioServiceAction::login($datos);

            return response(json_encode($respuesta));
        }
        catch (Exception $e) {
            throw new Exception($e);
        }
    }
}