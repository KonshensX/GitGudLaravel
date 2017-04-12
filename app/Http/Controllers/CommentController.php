<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class CommentController extends Controller
{

    public function create (Request $request) {

        //Insert the comment
        $data = $request->only('comment', 'id');
        $comment = Comment::create(['comment' => $data['comment'], 'post_id' => $data['id'], 'user_id' => Auth::user()->id]);

        return redirect()->route('post.full', [
            'id' => $data['id']
        ]);
    }

    public function remove (Request $request) {
        $id = Input::get('id');
        $comment = Comment::where('id', $id)->first();
        if (Auth::check()) {
            if (Auth::user()->id == $comment->user->id) {
                $comment->delete();
                $data = ['message' => 'comment_deleted'];
            }  else {
                $data = ['message' => 'comment_not_deleted'];
            }
        }
        //Get the comment and delete it
        //Return json response after deleting the comment 
    
        return response()->json($data);    
    }

    /**
     * Get comments for a post
     * @param $id
     */
    public function getPostComments ($id) {
        sleep(3);
        $posts = Post::where('id', $id)->first();

        return Response::json($posts->comments());
    }
}
