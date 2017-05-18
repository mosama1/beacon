<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use Beacon\Beacon;
class ApiController extends Controller
{
    public function get_location($couponId, $beaconId)
    {
      $response= array(
        'data' =>null ,
        'erros' => null
                    );
      try {
        $beacon = Beacon::where('beacon_id',$beaconId )->first();
        $response['data'] =  array(
          'url' => asset($beacon->location->logo),
          'name' =>$beacon->location->name,
        );
        return response()->json($response);
      } catch (\Exception $e) {
        $response['errors'] = $e->errorInfo;
        return response()->json($response);
      }


    }
}
