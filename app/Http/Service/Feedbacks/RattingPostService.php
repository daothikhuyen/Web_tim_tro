<?php

namespace App\Http\Service\Feedbacks;

use App\Http\Controllers\Feedbacks\Ratting_Post;
use App\Models\Ratting_Feedback;
use App\Models\Ratting_Posts;

class RattingPostService {

    public function getLike_Post(){
        $result = Ratting_Posts::select()->get();

        return $result;
    }

    public function getLike_Feedback($request){
        $result = Ratting_Feedback::where("feedback_id",$request->input("id"))->get();
        return $result;
    }

    public function insert_Post($request){

        return $this->insert_class(Ratting_Posts::class,$request->input("user_id"),"post_id",$request->input("post_id"));
    }


    public function insert_Feedback($request){
        return $this->insert_class(Ratting_Feedback::class,$request->input("user_id"),"feedback_id",$request->input("feedback_id"));
    }


    public function insert_class($insert_class,$userId,$nameWhere,$postId){

        $like = $insert_class::where("user_id", $userId)
                    ->where($nameWhere, $postId)->first();

        if($like == null){
            $result = $insert_class::create([
                "user_id" => $userId,
                $nameWhere => $postId,
                "like" => true
            ]);

            $status = $result ? 'like' : '';
            $message = $result ? 'Yêu thích thành công' : 'Yêu thích thất bại';
        }else{
            $result =  $insert_class::where("user_id", $userId)
                        ->where($nameWhere, $postId)->delete();

            $status = $result ? 'unlike' : '';
            $message = $result ? 'Yêu thích thành công' : 'Yêu thích thất bại';
        }

        return response()->json([
            "error" => $status==='',
            "status" => $status,
            "message" => $message
        ]);
    }

}
