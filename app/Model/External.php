<?php
/**
 * Created by PhpStorm.
 * User: micrium
 * Date: 20/10/2016
 * Time: 02:23 PM
 */

namespace App\Model;


class External
{
    
    public static function makeResponse($code=200, $message="OK", $type="N", $value=100)
    {
        return $result='<result><code>'.$code.'</code><message>'.$message.'</message><type>'.$type.'</type><entries><entry><value>'.$value.'</value></entry></entries></result>';
    }
    
}