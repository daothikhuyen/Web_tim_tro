<?php

namespace App\Http\Service\Posts;

use App\Models\Districts;
use App\Models\Extension;
use App\Models\Image;
use App\Models\Location;
use App\Models\Post;
use App\Models\Provinces;
use App\Models\User;
use App\Models\Video;
use App\Models\Wards;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CreatePostsService {

    public function getPosts(){
        $array = [];

        $postData =  Post::where('is_deleted', 0)->orderBy('id', 'desc')->get();
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

    public function getPost_ForMe($id){
        $items =  Post::where('is_deleted', 0)->where('user_id', $id)->paginate(10);

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

    public function store($request){

        $postData = $request->input("postData");
        $images = $request->input("images");
        $videos = $request->input("videos");
        $extensions = $request->input("extensions");


        $posts = Post::create([
            'title' =>$postData['title'],
            'description' => $postData['description'],
            'price' => $postData['price'],
            'area' => $postData['area'],
            'full_address' => $postData['full_address'],
            'user_id' => $postData['user_id'],
            'category_id' => $postData['category_id'],
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
                    'link_video' => $value['link_video'],
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

    public function destroy($request){
        $id = (int) $request->input('id');

        $posts = Post::where('id', $id)->first();

        if($posts){
            return Post::where('id', $id)->delete();
        }

        return false;
    }

    public function show($posts){
        $location_id = [$posts->province_id,$posts->district_id,$posts->ward_id];


        $province = Provinces::where('id',$posts->province_id)->first();
        $districts = Districts::where('id',$posts->district_id)->first();
        $ward = Wards::where('id',$posts->ward_id)->first();

        $location = array(
            'province' => $province->id,
            'district' => $districts->id,
            'ward' => $ward->id
        );

        $array = [
            'postData' => $posts,
            'images' => Image::where('post_id', $posts->id)->get(),
            'videos' => Video::where('post_id', $posts->id)->get(),
            'extensions'=>Extension::where('post_id', $posts->id)->get(),
            'locations' => $location,
        ];

        return $array;

    }

    public function update($request,$posts){

        $posts->fill($request->postData);
        $this->updatePosts(Image::class,$request->images,"id","link_image",$posts->id);
        $this->updatePosts(Video::class,$request->videos,"id","link_video",$posts->id);
        $this->updatePosts(Extension::class,$request->extensions,"name","name",$posts->id);
        $posts->save();

        return true;
    }

    public function updatePosts($class,$request,$columnRequest,$name_create,$postId){
        $arryRequest = array_column($request, $columnRequest);
        $selectById = $class::where('post_id', $postId)->get();

        foreach ($selectById as $item) {
            if (!in_array($item->$columnRequest, $arryRequest)) {
                $item->delete();
            }
        }

        foreach ($request as $value) {
            $existingExtension = $class::where($columnRequest, $value[$columnRequest])
                                        ->where('post_id', $postId)
                                        ->first();

            if (!$existingExtension) {
                $class::create([
                    $name_create => $value[$name_create],
                    'post_id' => $postId
                ]);
            }
        }

    }

    public function searchInput($request){

        if(Auth::check()){
            $user = Auth::user();

            if($request != null){
                $items = Post::where('user_id', $user->id)
                        ->where('title', 'like', "%{$request}%")->paginate(10);

            }else{
                $items =  Post::where('is_deleted', 0)->where('user_id', $user->id)->paginate(10);
            }
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
    }

    public function getBySearch($name,$on,$under){

        if($under !== null && $on !== null){
            $items = Post::whereBetween($name, [$on, $under])->orderBy('id', 'desc')->get();
        }else{
            if($on !== null){
                $items = Post::where($name, '>',$on)->orderBy('id', 'desc')->get();
            }else{
                $items = Post::where($name, '<',$under)->orderBy('id', 'desc')->get();
            }
        }

        $result = $this->CreateArray($items);
        return $result;
    }

    public function searchInputAll($request){
        $items = Post::where('full_address', 'like', "%{$request}%")
                    ->orWhere('title', 'like',"%{$request}%" )->get();

        $result = $this->CreateArray($items);
        return $result;
    }

    public function searchByLocation_Id($request){
        if($request->district_id == 0){
            $items = Post::where('province_id', $request->province_id)->get();
        }
        else{
            if($request->ward_id == 0){
                $items = Post::where('province_id', $request->province_id)
                            ->where('district_id', $request->district_id)->get();
            }
            else{
                $items = Post::where('province_id', $request->province_id)
                            ->where('district_id', $request->district_id)
                            ->where('ward_id',$request->ward_id)->get();
            }
        }

        $result = $this->CreateArray($items);
        return $result;
    }

    public function CreateArray($items){
        $array = [];
        foreach ($items as $value) {
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

    public function list_SearchSuggestion($request){

        try {
            $result = Post::where('is_deleted', 0)->where('title', 'like', "%{$request->input}%")
                            ->orderByDesc('id')
                            ->select('title as title_suggestion')->limit(10)->get();

            if($result->isEmpty()){
                $result = Post::where('is_deleted', 0)->where('full_address', 'like', "%{$request->input}%")
                                ->orderByDesc('id')
                                ->select('full_address as title_suggestion')->limit(10)->get();
            }

            return $result;
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return false;
        }



    }

}
