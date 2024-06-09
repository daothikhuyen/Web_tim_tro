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

        $location = Location::select()->get();

        return $location;
    }

    public function getNameLocation(Request $request){
        $array = [];

        foreach ($request as $key => $value) {
            if($request[$key] !== null){
                $array[$key] = $request[$key];
            }
        }

        return Location::whereIn('id',$request)->get();
    }

    public function getLocationByParent_id(Request $request){
        $result = Location::where('parent_id',$request->parent_id)
                        ->where('type',$request->type)->get();

        return response()->json([
            'error' => $result?false:true,
            'locations' => $result
        ]);

    }
}
