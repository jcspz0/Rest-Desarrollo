<?php
/**
 * Created by PhpStorm.
 * User: micrium
 * Date: 19/10/2016
 * Time: 02:39 PM
 */

namespace App\Utils;




use App\Log;

class MyLog
{
    public static function registrar($dato)
    {
        Log::create([
            'log' => $dato,
        ]);
    }
}