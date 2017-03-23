<?php

namespace Beacon\Http\Managers;

use GuzzleHttp\Client;

class ServiceManager
{
static $token;
private static $url= config('');
 public static function getAnalytics($array, $startDate,$endDate){
	 $access_token= self::getToken();
	 $client=new Client();
	 $cleint->get()
 }
 private static function getToken(){
	 $client=new Client();
	 $params=[
		'form_params' => [
						'client_id' => config('services.beacon.client_id'),
						'client_secret' => config('services.beacon.client_secret'),
						'scope' => config('services.beacon.analytics_scope')
				]
	 ];
	 
    $response = $client->request('POST',config('services.beacon.redirect'),$params);
		$json_c = $response->getBody();
		$token= json_decode($json_c);
     return $token->access_token;
 }
}
