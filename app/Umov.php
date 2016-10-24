<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use GuzzleHttp;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

use Convert;

class Umov extends Model
{
    public static function getToken($login, $enviroment, $password){
    	//$base='jcspz0.hol.es';
        $base='localhost';

        if(!Umov::authentication($login, $enviroment, $password)){
            return null;
        }

        $clientToken = new Client([
            // Base URI is used with relative requests
            // 'base_uri' => 'http://'.$base.'/Rest/public/',
            'base_uri' => 'https://api.umov.me/CenterWeb/api/',
            // You can set any number of default request options.
            //'timeout'  => 2.0,
            // para redirecciones
            //'allow_redirects' => false,
            //activar el modo debug
            //'debug' => true,
        ]);

        // tipos de datos $tipo_dato = json  , multipart  , form_params, body
        $tipo_dato = 'form_params';
        // $contenido = '<schedule>
        //                 <alternativeIdentifier>Tarefa XsXX</alternativeIdentifier>
        //                 <activityHistories>
        //                   <activityHistory id="8988776655445393"/>
        //                 </activityHistories>
        //               </schedule>';
        $dato = '<apiToken>
                    <login>'.$login.'</login>
                    <password>'.$password.'</password>
                    <domain>'.$enviroment.'</domain>
                </apiToken>';  
        try{
            $response = $clientToken->request('POST','token.xml',[ $tipo_dato => ['data' => $dato]]);
            $array = Convert::convertXMLtoJSON($response->getBody());
            $token = $array['message'];
            return $token;
        }catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
            echo "hubo un problema en el retorno del token";
            return null;
        }
    }

    public static function authentication($login, $enviroment, $password){
        $client = new Client([
            'base_uri' => 'https://api.umov.me/CenterWeb/api/',
            ]);
        $tipo_dato = 'form_params';
        $dato = '<authentication>
                    <login>'.$login.'</login>
                    <password>'.$password.'</password>
                    <domain>'.$enviroment.'</domain>
                </authentication>'; 
        try{
            $response = $client->request('POST','authentication.xml', [ $tipo_dato => ['data' => $dato]]);
            $array = Convert::convertXMLtoJSON($response->getBody());
            $token = $array['statusCode'];
            // if($token == '200'){
            //     return true;
            // }else{
            //     return false;
            // }
            return $token;
        }catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
            echo "hubo un problema en la autenticacion";
            return null;
        }        
    }
 
    public static function getListAgents($token){
    	$client = new Client([
    		'base_uri' => 'https://api.umov.me/CenterWeb/api/',
    		]);

    }

}
