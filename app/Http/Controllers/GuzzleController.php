<?php

namespace App\Http\Controllers;

use App\Model\Umov\Login;
use App\Model\Umov\Activity;
use App\Model\Umov\Umov;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use GuzzleHttp;
use GuzzleHttp\Client;


class GuzzleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $login = 'master';
        $enviroment = 'formacionjuan';
        $password = 'micrium2016';
        $client = new Client([
            'base_uri' => 'http://localhost/Rest-Desarrollo/public/',
            ]);
        $tipo_dato = 'form_params';
        $response = $client->request('POST','guz',
                [ $tipo_dato => 
                    ['login' => $login ,
                     'enviroment' => $enviroment ,
                     'password' => $password,
                    ]
                ]);
        $body = $response->getBody();
        return $body;
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
        $login = $request->Input('login');
        $enviroment = $request->Input('enviroment');
        $password = $request->Input('password');
        $token = Umov::getToken($login, $enviroment, $password);
        $activities = Umov::getDataById($token, "agent",259735);
        //$activities = Umov::postDataById($token, "agent",259735,"<agent><name>Jc</name></agent>");
        //$activities = Umov::getAllActivitiesIdBy($token,'description','realizar pedido');
        //$result = Umov::getActivityById($token,$activities[0]);
        if($token == null){
            return "ha fallado el getActiviries";
        }
        return $activities;
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
