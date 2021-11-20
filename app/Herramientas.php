<?php

namespace App;

use Illuminate\Support\Facades\Log;

class Herramientas
{
    public static function fechaActual() {
        return date('Y-m-d H:i:s');
    }
}
