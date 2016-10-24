<?php
/**
 * Created by PhpStorm.
 * User: micrium
 * Date: 21/10/2016
 * Time: 03:41 PM
 */

namespace App\Model\Umov;

use GuzzleHttp;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

use App\Utils\Convert;

class Activity
{
    public static function getAllActivitiesId($token)
    {
        /**
         * Devuelve todas las actividades del ambiente de uMov
         *
         * @access public
         * @param String $token token del ambiente
         * @return array $result retorna todas las actividades del ambiente
         * @throws Exception si no se puede conectar a uMov
         */
        $client = new Client([
            'base_uri' => 'https://api.umov.me/CenterWeb/api/'.$token.'/',
        ]);
        $url='activity.xml';
        try{
            $result=null;
            $response = $client->request('GET',$url);
            $array = Convert::convertXMLtoJSON($response->getBody());
            $i=0;
            foreach ($array['entries']['entry'] as $actividad){
                foreach ($actividad as $a){
                    if(isset($a['id'])){
                        $result[$i]=$a['id'];
                    }else{
                        $result[$i]=$actividad['id'];
                    }
                }
                $i++;
            }
            return $result;
        }catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
            echo "hubo un problema en la autenticacion";
            return null;
        }
    }

    public static function getAllActivitiesIdBy($token,$field,$value)
    {
        /**
         *  Devuelve en un array los ID's de las actividades de un ambiente por campos de busqueda, el valor puede contener espacios
         *
         * @access public
         * @param String $token token del ambiente
         * @param String $field campo de la actividad por la cual se va a ejecutar la busqueda
         * @param String $value el valor del campo por el cual se va a realizar la busqueda
         * @return array $result retorna un array con todas las actividades encontradas en la busqueda, es null si no se encuentra ningun registro
         * @throws Exception cuando no se puede conectar a Umov y retorna null
         */
        $client = new Client([
            'base_uri' => 'https://api.umov.me/CenterWeb/api/'.$token.'/',
        ]);
        $url='activity.xml?'.$field.'='.Convert::convertSpaceBlankToUrl($value);
        try{
            $result=null;
            $response = $client->request('GET',$url);
            $array = Convert::convertXMLtoJSON($response->getBody());
            $i=0;
            foreach ($array['entries']['entry'] as $actividad){
                foreach ($actividad as $a){
                    if(isset($a['id'])){
                        $result[$i]=$a['id'];
                    }else{
                        $result[$i]=$actividad['id'];
                    }
                }
                $i++;
            }
            return $result;
        }catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
            echo "hubo un problema en el response";
            return null;
        }catch (\Exception $e){
            echo $e;
            return null;
        }
    }

    public static function getActivityById($token, $activity_id)
    {
        /**
         * devuelve todos los valores de una actividad en especifico por el criterio de busqueda del ID
         *
         * @access public
         * @param $token es el token del ambiente
         * @param $activity_id es el id de la actividad que se va a buscar
         * @return array $result retorna un array con todos
         * @throws Exception no se pudo conectar con uMov
         */
        $client = new Client([
            'base_uri' => 'https://api.umov.me/CenterWeb/api/'.$token.'/',
        ]);
        $url='activity/'.$activity_id.'.xml';
        try{
            $result=null;
            $response = $client->request('GET',$url);
            $array = Convert::convertXMLtoJSON($response->getBody());
            $result = $array;
            return $result;
        }catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
            echo "hubo un problema en la autenticacion";
            return null;
        }
    }

}