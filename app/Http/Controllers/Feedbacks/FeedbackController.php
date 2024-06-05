<?php

namespace App\Http\Controllers\Feedbacks;

use App\Http\Controllers\Controller;
use App\Http\Service\Feedbacks\FeedbackService;
use App\Models\Post;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    protected $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    public function index(Request $request,Post $posts){

        $result = $this->feedbackService->getFeedback($posts->id);

        if($result){
            return response()->json([
                'error' => false,
                'message' => $result["feedback"],
                "total_feedback" => $result["total_feedback"]
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => "Thất bại",
                "total_feedback" => 0
            ]);
        }

    }

    public function store(Request $request){

        $result = $this->feedbackService->insertFeedback($request);

        if($result){
            return response()->json([
                'error' => false,
                'message' => "Thành công",
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => "Thất bại",
            ]);
        }
    }
}
