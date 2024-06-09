<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Service\Posts\CreatePosts_AdminService;
use App\Jobs\SendMail_DestroyPosts;
use App\Jobs\SendMail_ResetPass;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatePosts_Admin extends Controller
{
    protected $createposts_AdminService;

    public function __construct(CreatePosts_AdminService $createposts_AdminService)
    {
        $this->createposts_AdminService = $createposts_AdminService;
    }


    public function list_posts_user(){

        if(Auth::check()){
            $user = Auth::user();
            $result = $this->createposts_AdminService->list_posts_user();
            return $result;
        }
        return false;
    }

    public function show_detail(Post $posts){

        $result = $this->createposts_AdminService->show_detail($posts);
        return $result;
    }

    public function destroy_posts(Post $posts){

        $user = User::where('id', $posts->user_id)->first();
        SendMail_DestroyPosts::dispatch($user,$posts);

        $posts->is_deleted = 1;
        $posts->save();

        return response()->json([
            'error' => false
        ]);
    }
}
