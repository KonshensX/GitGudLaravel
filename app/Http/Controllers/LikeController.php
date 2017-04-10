<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    /**
     * Like a post with the given id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function like(Request $request) {
        //Get the post id to insert in the post table via the request
        //Store the like in the likes table, no pivot table required
        //Check if post is already liked
        //Checking if the row exists in the likes table
        $post_id = $request->only('id')['id'];
        $liked = Like::where(['user_id' => Auth::user()->id, 'post_id' => $post_id])->first();
        if ($liked) {
            $this->unlike($liked);

            return response()->json([
                'liked' => false,
                'likesCount' => Like::where('post_id', $post_id)->count()
            ]);
        }
        $like = Like::create(['user_id' => Auth::user()->id, 'post_id' => $request->only('id')['id']]);

        return response()->json([
            'liked' => true,
            'likesCount' => Like::where('post_id', $post_id)->count()
        ]);
    }


    public function unlike(Like $likeEntity) {
        //Get the post id to unlike, this is comming via the request
        $likeEntity->delete();
    }
}
