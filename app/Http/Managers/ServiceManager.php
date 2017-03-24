<?php

namespace Beacon\Http\Managers;

use GuzzleHttp\Client;

class ServiceManager
{
static $token;

 public function getAnalytics($queryarray){ 
	 $url= config('services.beacon.analytics');
	 
	 $token=$this->getToken();
	 $params=$this->setParams($queryarray, $token,'analytics');
	 $client=new Client();
	 $response=$client->request('GET',$url, $params );
	 $result=json_decode($response->getBody());
	 return $result;
 }
 public function getVisits( $queryarray=[]){ 
	 $url= config('services.beacon.visits');
	 $token=$this->getToken();
	 $params=$this->setParams($queryarray, $token,'visits');
	 $client=new Client();
	 $response=$client->request('GET',$url, $params );
	 $result=json_decode($response->getBody());
	 return $result;
 }
 private function setParams($queryarray, $token,$type){
	 if ($type=='analytics') {
		 return[
		  'headers' => ['Authorization' => 'Bearer '.$token ],
		  'query'=>[
			  'startDate'=> $queryarray['startDate'],
			  'endDate'=>$queryarray['endDate'],
			  'locations'=>$queryarray['location'],
			  'types'=>$queryarray['types'],
		  ]
	  ];
	 }
	 else{

		 return[
		  'headers' => ['Authorization' => 'Bearer '.$token ],
		  'query'=>[
			  'startDate'=> $queryarray['startDate'],
			  'endDate'=>$queryarray['endDate'],
			  'locations'=>$queryarray['location'],
		  ]
	  ];
	 }
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
