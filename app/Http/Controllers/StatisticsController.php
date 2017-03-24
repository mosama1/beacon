<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use Beacon\Http\Managers\ServiceManager;
/**
  *This Controller allows to manage the statistic module of Beacons
  */
class StatisticsController extends Controller
{
    /**
    * index function
    *@return statistics
    */
    public function index(){
      
       return view('statistics.statistics');   
    }
    public function getData(){
      $result=$this->newsRecurrentsAndUniques();
      
      return response()->json($result);
    }
    /*
    *
    */
    private function newsRecurrentsAndUniques(){
      $params= config('services.beaconParams.analytics');
      $params['types']=[
        'NEW_VS_RETURNING',
        'UNIQ_VISITORS'
      ];
      $service= new ServiceManager();
      $result= $service->getAnalytics($params);

      return $result->analytics;
    }
     private function visitors(){
      $params= config('services.beaconParams.analytics');
      $service= new ServiceManager();
      $result= $service->getAnalytics($params);

      return $result;
    }
}
