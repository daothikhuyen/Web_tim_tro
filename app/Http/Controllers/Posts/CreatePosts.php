<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Service\Posts\CreatePostsService;
use Illuminate\Http\Request;

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
                'message' => $result
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => $result
            ]);
        }
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
}
