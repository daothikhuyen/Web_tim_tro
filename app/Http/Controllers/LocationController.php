<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Districts;
use App\Models\Location;
use App\Models\Province;
use App\Models\Provinces;
use App\Models\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{

    // public function getLocation(){

    //     $location = Location::select()->get();

    //     return $location;
    // }

    public function get_Provinces(){

        $proviences = Provinces::select()->get();
        return $proviences;
    }

    public function get_Districts(Request $request){

        $districts = Districts::where('province_id', $request->province_id)->get();
        return $districts;
    }

    public function get_Wards(Request $request){

        $wards = Wards::where('district_id', $request->district_id)->get();
        return $wards;
    }

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

    // public function getNameLocation(Request $request){
    //     $array = [];

    //     foreach ($request as $key => $value) {
    //         if($request[$key] !== null){
    //             $array[$key] = $request[$key];
    //         }
    //     }

    //     return Location::whereIn('id',$request)->get();
    // }

    // public function getLocationByParent_id(Request $request){
    //     $result = Location::where('parent_id',$request->parent_id)
    //                     ->where('type',$request->type)->get();

    //     return response()->json([
    //         'error' => $result?false:true,
    //         'locations' => $result
    //     ]);

    // }
}
