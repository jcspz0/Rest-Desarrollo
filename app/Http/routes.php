<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::resource('rest','RestController');
Route::resource('callback','CallbackController');

Route::resource('guz','GuzzleController');

Route::resource('external','ExternalConnectionController');

Route::get('/', function () {
	// $xml = XmlParser::load('<api><user followers="5"><id>1</id><email>crynobone@gmail.com</email></user></api>');
	// $user = $xml->parse([
	//     'id' => ['uses' => 'user.id'],
	//     'email' => ['uses' => 'user.email'],
	//     'followers' => ['uses' => 'user::followers'],
	// ]);
    
 //    dd($user);
	return Input::all();
});
