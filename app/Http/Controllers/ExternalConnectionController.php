<?php

namespace App\Http\Controllers;

use App\Utils\MyLog;
use App\Model\External;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use GuzzleHttp;
use GuzzleHttp\Client;

use App\Utils\Convert as Convert;

use GuzzleHttp\Psr7\Request as guzRequest;

class ExternalConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = '<context><event><workspace>formacionjuan</workspace><workspaceId>16423</workspaceId><connectorParameter></connectorParameter></event><historicals><activityHistorical><id>20</id><dataSource>0</dataSource><activity><id>394733</id><description>realizar pedido</description><alternativeIdentifier>id integracion actividad</alternativeIdentifier></activity><startTimeOnSystem>2016-10-20 16:02:38</startTimeOnSystem><finishTimeOnSystem></finishTimeOnSystem><scheduleId>39251306</scheduleId></activityHistorical></historicals></context>';

        $xml=simplexml_load_string($data)->asXML(); //or die("Error: Cannot create object");
        $uri='http://localhost/Rest-Desarrollo/public/external';
        $client = new Client();
        $request = new guzRequest('POST', $uri,['Content-Type' => 'text/xml; charset=UTF8'],$xml);
        $response = $client->send($request);

        /*$client = new Client([
            'base_uri' => 'http://localhost/Rest-Desarrollo/public/',
        ]);
        $tipo_dato = 'form_params';
        $response = $client->
        request('POST','external',
            [ $tipo_dato =>
                ['data' => $xml2 ,
                ]
            ]);*/

        $body = $response->getBody();
        //$array = Convert::convertXMLtoJSON($body);
        return $body;

        //return "asd";//"servicio rest para las conexiones externas";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo $request->getContent();
        //$dato = Convert::convertXMLtoJSON($request->getContent());
        //$xml = simplexml_load_string($request);
        //dd($dato);
        MyLog::registrar('ingresaron al servicio por POST de external, los datos enviados son = '.$request->getContent());
        try{
            if(is_null($request->getContent())){
                throw new \Exception('variable incorrecta');
            }
            $array = Convert::convertXMLtoJSON($request->getContent());
            //dd($array);
            if(is_null($array)){
                throw new \Exception('el dato enviado no es un XML');
            }
            //tengo que obtener la informacion, y procesarla

            //devuelvo un resultado
            $result = External::makeResponse();
            MyLog::registrar('se termino de procesar la peticion de external el resultado es -> '.$result);
            return $result;
        }catch(\Exception $e){
            if($request->getContent() == null){
                MyLog::registrar('no se enviaron bien los datos al servicio external || la variable enviada no tiene el nombre de data');
                return $result = External::makeResponse(400,'la variable no tiene el nombre data','N',0);
            }
            $array = Convert::convertXMLtoJSON($request->getContent());
            if(is_null($array)){
                MyLog::registrar('no se enviaron bien los datos al servicio external || el XML no esta correcto, no se puede parsear');
                return $result = External::makeResponse(400,'la variable no se puede parasear','N',0);
            }
            MyLog::registrar('hubo alguna excepcion del servicio external || el Request es el siguiente-> '.$request->input('data'));
            return $result = External::makeResponse(400,'ocurrio un problema','N',0);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
