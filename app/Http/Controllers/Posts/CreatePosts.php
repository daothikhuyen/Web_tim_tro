<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Service\Posts\CreatePostsService;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatePosts extends Controller
{
    protected $createpostsService;

    public function __construct(CreatePostsService $createPostsService)
    {
        $this->createpostsService = $createPostsService;
    }

    public function index(){
        $result = $this->createpostsService->getPosts();

        if($result){
            return response()->json([
                'error' => false,
                'posts' => $result
            ]);
        }else{
            return response()->json([
                'error' => true,
                'posts' => $result
            ]);
        }
    }

    public function getPost_ForMe(){

        if(Auth::check()){
            $user = Auth::user();
            $result = $this->createpostsService->getPost_ForMe($user->id);
            return $result;
        }
        return false;

    }

    public function store(Request $request){

        $result = $this->createpostsService->store($request);

        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Thành công'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Thất bại'
            ]);
        }
    }

    public function destroy(Request $request){

        $result = $this->createpostsService->destroy($request);

        return response()->json([
            'error' => $result?false:true,
        ]);
    }

    public function show(Post $posts){
        return $this->createpostsService->show($posts);
    }

    public function update(Request $request, Post $posts){

        $result = $this->createpostsService->update($request,$posts);

        return response()->json([
            'error' => $result?false:true,
        ]);
    }

    public function searchInput(Request $request){

        $result = $this->createpostsService->searchInput($request[0]);

        if($result){
            return $result;
        }
    }

    public function getBySearch(Request $request){
        $result = $this->createpostsService->getBySearch($request->name,$request->on,$request->under);

        return response()->json([
            'error' => $result?false:true,
            'posts' => $result
        ]);
    }

    public function searchInput_All(Request $request){

        $result = $this->createpostsService->searchInputAll($request[0]);

        return response()->json([
            'error' => $result?false:true,
            'posts' => $result
        ]);
    }

    public function searchByLocation_Id(Request $request){

        $result = $this->createpostsService->searchByLocation_Id($request);

        return response()->json([
            'error' => $result?false:true,
            'posts' => $result
        ]);
    }
}
