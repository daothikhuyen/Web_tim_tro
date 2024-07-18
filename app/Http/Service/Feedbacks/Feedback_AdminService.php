<?php

namespace App\Http\Service\Feedbacks;

use App\Models\Feedback;

class Feedback_AdminService {

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

    public function getList_comment($post_id){
        $items =  Feedback::where('post_id', $post_id)->where('is_deleted', 0)->with('user')->get();

        $result = $this->Recursive($items,0);
        return $result;
    }
}

