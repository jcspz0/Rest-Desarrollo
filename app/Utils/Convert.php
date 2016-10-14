<?php
	
namespace App\Utils;

class Convert
{
	public static function convertXMLtoJSON($request){
		try{
			$xml = simplexml_load_string($request);
	        $json = json_encode($xml);
	        $array = json_decode($json,TRUE);
	        return $array;
		}catch(\Exception $e){
			echo "hubo un error en la conversion";
			return null;
		}
	}
}