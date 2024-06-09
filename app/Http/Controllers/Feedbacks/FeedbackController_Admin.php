<?php

namespace App\Http\Controllers\Feedbacks;

use App\Http\Controllers\Controller;
use App\Http\Service\Feedbacks\Comment_AdminService;
use App\Http\Service\Feedbacks\Feedback_AdminService;
use App\Models\Feedback;
use App\Models\Post;
use Illuminate\Http\Request;

class FeedbackController_Admin extends Controller
{
    protected $comment_adminservice;

    public function __construct(Feedback_AdminService $comment_adminservice)
    {
        $this->comment_adminservice = $comment_adminservice;
    }

    public function getList_comment(Request $request,Post $posts){
        $result = $this->comment_adminservice->getList_comment($posts->id);

        return response()->json([
            'error' => $result?false:true,
            'data' => $result
        ]);
    }

    public function destroyFeedback(Feedback $feedback){
        try {
            $feedback->is_deleted = 1;
            $feedback->save();

            $result = Feedback::where('parent_id',$feedback->id)->get();
            foreach ($result as $value) {
                $value->is_deleted = 1;
                $value->save();
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
