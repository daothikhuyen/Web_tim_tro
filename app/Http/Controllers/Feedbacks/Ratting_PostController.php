<?php

namespace App\Http\Controllers\Feedbacks;

use App\Http\Controllers\Controller;
use App\Http\Service\Feedbacks\RattingPostService;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;

class Ratting_PostController extends Controller
{
    protected $ratting_post_service;

    public function __construct(RattingPostService $ratting_post_service)
    {
        $this->ratting_post_service = $ratting_post_service;
    }

    public function index_Post(){
        $result = $this->ratting_post_service->getLike_Post();

        return response()->json([
            "error" => $result?false:true,
            "message" => $result
        ]);
    }

    public function index_Feedback(Request $request){
        $result = $this->ratting_post_service->getLike_Feedback($request);

        return response()->json([
            "error" => $result?false:true,
            "message" => $result
        ]);

    }

    public function store_Post(Request $request){
        $result = $this->ratting_post_service->insert_Post($request);
        return $result;
    }

    public function store_Feedback(Request $request){
        $result = $this->ratting_post_service->insert_Feedback($request);

        return $result;
    }
}
