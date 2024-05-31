<?php

namespace App\Http\Service\Posts;

use App\Models\Extension;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;

class CreatePostsService {

    public function getPosts(){
        $array = [];

        $postData =  Post::orderBy('id', 'desc')->get();

        foreach ($postData as $value) {
            $new = [];

            $new['postData'] = $value;
            $new['user'] = User::where('id', $value['user_id'])->first();
            $new['images'] = Image::where('post_id',$value['id'])->get();
            $new['videos'] = Video::where('post_id',$value['id'])->get();
            $new['extensions'] = Extension::where('post_id',$value['id'])->get();

            $array[] = $new;
        }

        return $array;
    }

    public function store($request){

        $postData = $request->input("data")["postData"];
        $images = $request->input("data")["images"];
        $videos = $request->input("data")["videos"];
        $extensions = $request->input("data")["extensions"];

        // dd($request);
        $posts = Post::create([
            'title' =>$postData['title'],
            'description' => $postData['description'],
            'price' => $postData['price'],
            'area' => $postData['arceage'],
            'full_address' => $postData['full_address'],
            'user_id' => $postData['user_id'],
            'category_id' => $postData['category_id'],
            // 'video_link' =>  $postData['video_link'],
            'province_id' => $postData['province_id'],
            'district_id' => $postData['district_id'],
            'ward_id' => $postData['ward_id'],
            'street_id' => $postData['street_id'],

        ]);

        if($posts){
            foreach ($images as $key => $value) {
                $image = Image::create([
                    'link_image' => $value['link_image'],
                    'post_id' => $posts->id
                ]);
            }

            foreach ($videos as $key => $value) {
                $video = Video::create([
                    'video_link' => $value['link_video'],
                    'post_id' => $posts->id
                ]);
            }

            foreach ($extensions as $key => $value) {
                $extension = Extension::create([
                    'name' => $value['name'],
                    'post_id' => $posts->id
                ]);
            }

            return true;
        }else{
            return false;
        }


    }
}
