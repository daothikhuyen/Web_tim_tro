<?php

namespace App\Http\Service\Posts;

use App\Models\Extension;
use App\Models\Image;
use App\Models\Location;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;

class CreatePosts_AdminService {

    public function list_posts_user(){
        $items =  Post::where('is_deleted', 0)->paginate(10);

        $response = [
            'paginate' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem()
            ],
            'data' => $items
        ];

        return response()->json($response);
    }

    public function show_detail($posts){
        $location_id = [$posts->province_id,$posts->district_id,$posts->ward_id,$posts->street_id];

            $array = [
                'user' => User::where('id', $posts->user_id)->first(),
                'postData' => $posts,
                'images' => Image::where('post_id', $posts->id)->get(),
                'videos' => Video::where('post_id', $posts->id)->get(),
                'extensions'=>Extension::where('post_id', $posts->id)->get(),
                'locations' => Location::whereIn('id',$location_id)->get(),
            ];

            return $array;
    }
}
