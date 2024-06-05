<?php

namespace App\Http\Service\Feedbacks;

use App\Models\Feedback;

class FeedbackService {

    public function Recursive($feedback,$parent_id = 0){
        $array = [];
        foreach ($feedback as $value) {

            if($value['parent_id'] == $parent_id){

                $children = $this->Recursive($feedback,$value['id']);

                $value['feedback'] = [];
                if(!empty($children)){

                    $value['feedback'] = $children;

                }


                $array[] = $value;
            }

        }

        return $array;
    }

    public function getFeedback($request){
        $array = [];

        $result = Feedback::where('post_id', $request)->with('user')->get();
        $number = Feedback::where('post_id',$request)->count();

        $feedback = $this->Recursive($result,0);

        $array['feedback'] = $feedback;
        $array['total_feedback'] = $number;

        return $array;
    }

    public function insertFeedback($request){

        $result = Feedback::create([
            "user_id" => $request->input('user_id'),
            "post_id" => $request->input("post_id"),
            "comment" => $request->input("comment"),
            "parent_id" => $request->input("parent_id")
        ]);

        return $result;

    }
}
