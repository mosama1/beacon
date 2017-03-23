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

       // return view('statistics.statistics');
       return ServiceManager::token();
    }
}
