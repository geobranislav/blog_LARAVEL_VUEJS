<?php

namespace App\Http\Controllers;

use App\PostUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostUserController extends Controller
{
    public function liked(Request $request)
    {
        //$userID = Auth::user()->id;
        $canLike = true;
        $post = PostUser::orderBy('id','DESC')->get();
        foreach ($post as $value){
            if($value->post_id == $request->postId && $value->user_id == Auth::user()->id){
              $canLike = false;
            }
        }

        if($canLike)
        {
            $like = new PostUser();
            $like->user_id = Auth::user()->id;
            $like->post_id = $request->postId;
            $like->save();
            //\Log::info($like->getLikedPostUser($request->postId));
            $log = $like->getLikedPostUser($request->postId);
            //\Log::info($log);

            return $log;
        } else {
            return "vec si lajkovao";
        }

    }
}
