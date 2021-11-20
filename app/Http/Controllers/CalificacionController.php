<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\Data\CalificacionServiceData;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Exception;

class CalificacionController extends Controller
{
    /**
     * 
     */
    public function listarCalificaciones(Request $request)
    {

        try {
            
            $datos = $request->all();

            $respuesta = CalificacionServiceData::listarCalificaciones($datos);

            return response($respuesta);
        }
        catch (Exception $e) {
            throw new Exception($e);
        }
    }
}