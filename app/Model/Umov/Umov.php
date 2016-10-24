<?php

namespace App\Model\Umov;

use Illuminate\Database\Eloquent\Model;

use GuzzleHttp;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

use App\Utils\Convert;

class Umov extends Model
{
    public static function getToken($login, $enviroment, $password){
        /**
         * devuelve el token del ambiente al que quiere ingresar, pasando primero por una autenticacion
         *
         * @access public
         * @param String $login el login del usuario
         * @param String $enviroment el ambiente de uMov
         * @param String $password contrasenia del usuario
         * @return String $token retorna el doken del ambiente
         * @throws Exception ocurre una exception cuando la informacion de logueo es incorrecta, retorna null
         */
        //$base='jcspz0.hol.es';
        $base='localhost';

        if(!Login::authentication($login, $enviroment, $password)){
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

    public static function authentication($login, $enviroment, $password)
    {
        /**
         * verifica si los credenciales ingresados son validos para uMov
         *
         * @access public
         * @param String $login el login del usuario
         * @param String $enviroment el ambiente de uMov
         * @param String $password contrasenia del usuario
         * @return String $token retorna el statusCode de la validacion, 200 si es correcta, otro si no lo es
         * @throws Exception ocurre una exception cuando la informacion de logueo es incorrecta, retorna null
         */
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

    public static function getAllDataId($token, $data)
    {
        /**
         * Devuelve todas las actividades del ambiente de uMov
         *
         * @access public
         * @param String $token token del ambiente
         * @param String $data el dato que quiere consultar
         * @return array $result retorna todas las actividades del ambiente
         * @throws Exception si no se puede conectar a uMov
         */
        $client = new Client([
            'base_uri' => 'https://api.umov.me/CenterWeb/api/'.$token.'/',
        ]);
        $url=$data.'.xml';
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

    public static function getAllDataIdByCriteria($token, $data, $field, $value)
    {
        /**
         *  Devuelve en un array los ID's de las actividades de un ambiente por campos de busqueda, el valor puede contener espacios
         *
         * @access public
         * @param String $token token del ambiente
         * @param String $data el dato que quiere consultar
         * @param String $field campo de la actividad por la cual se va a ejecutar la busqueda
         * @param String $value el valor del campo por el cual se va a realizar la busqueda
         * @return array $result retorna un array con todas las actividades encontradas en la busqueda, es null si no se encuentra ningun registro
         * @throws Exception cuando no se puede conectar a Umov y retorna null
         */
        $client = new Client([
            'base_uri' => 'https://api.umov.me/CenterWeb/api/'.$token.'/',
        ]);
        $url=$data.'.xml?'.$field.'='.Convert::convertSpaceBlankToUrl($value);
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

    public static function getDataById($token, $data, $activity_id)
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
        $url=$data.'/'.$activity_id.'.xml';
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

    public static function getDataByAlternativeIdentifier($token, $data, $alternative_identifier)
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
        $url=$data.'/alternativeIdentifier/'.$alternative_identifier.'.xml';
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

    //-------------
    public static function postDataById($token, $data, $activity_id, $cadena)
    {
        /**
         * registra todos los valores de una actividad en especifico por el criterio de busqueda del ID
         *
         * @access public
         * @param $token es el token del ambiente
         * @param $activity_id es el id de la actividad que se va a buscar
         * @param String $cadena es la cadena que necesita uMov para ingresar lso datos
         * @return array $result retorna un array con datos especificando los valores ingresados
         * @throws Exception no se pudo conectar con uMov
         */
        $client = new Client([
            'base_uri' => 'https://api.umov.me/CenterWeb/api/'.$token.'/',
        ]);
        $url=$data.'/'.$activity_id.'.xml';
        try{
            $result=null;
            $tipo_dato = 'form_params';
            $response = $client->request('POST',$url,
                [ $tipo_dato =>
                    [   'data' => $cadena ,]
                ]);
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

    public static function postDataByAlternativeIdentifier($token, $data, $alternative_identifier, $cadena)
    {
        /**
         * registra todos los valores de una actividad en especifico por el criterio de busqueda del ID
         *
         * @access public
         * @param $token es el token del ambiente
         * @param $activity_id es el id de la actividad que se va a buscar
         * @param String $cadena es la cadena que necesita uMov para ingresar lso datos
         * @return array $result retorna un array con datos especificando los valores ingresados
         * @throws Exception no se pudo conectar con uMov
         */
        $client = new Client([
            'base_uri' => 'https://api.umov.me/CenterWeb/api/'.$token.'/',
        ]);
        $url=$data.'/alternativeIdentifier/'.$alternative_identifier.'.xml';
        try{
            $result=null;
            $tipo_dato = 'form_params';
            $response = $client->request('POST',$url,
                [ $tipo_dato =>
                    [   'data' => $cadena ,]
                ]);
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
