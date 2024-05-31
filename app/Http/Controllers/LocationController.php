<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Location;
use App\Models\Province;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function Recursive($request,$parent_id = 0){
        $result = [];

        foreach ($request as $value) {

            if($value['parent_id'] == $parent_id){

                $children = $this->Recursive($request,$value['id']);


                if(!empty($children)){

                    $value['location'] = $children;

                }

                $result[] = $value;
            }
        }

        return $result;
    }

    public function getLocation(){
        $array = [];
        $location = Location::select()->get();
        $this->Recursive($location,0);

        if($location){
            return response()->json([
                'error' => false,
                'message' => $location
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => $location
            ]);
        }
    }
}
