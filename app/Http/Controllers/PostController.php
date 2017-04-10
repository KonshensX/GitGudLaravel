<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{

    public function index () {

        $posts = Post::limit(30)->orderBy('created_at', 'DESC')->get();
        return view('post.index', compact('posts'));
    }

    public function add (Request $request) {

    }

    public function store (Request $request) {
        if (!Auth::check()) {
            return response()->json([
                'error' => "You're not logged in, you're not allowed to post"
            ]);
        }
        $attachment = null;
        //dd(Auth::user()->id);
        if (Input::hasFile('file-upload')) {

            $file = Input::file('file-upload');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $filename = md5($filename) . '.' . $extension;
            $file->storePubliclyAs('uploads/attachments', $filename, 'public');
            //Store the attachment and retrieve the id
            $attachment = Attachment::create([
                //'post_id' => $post->id,
                'attachment_path' => $filename]);
            //$data['attachment_id'] = $filename;
        }
        $post = Post::create(['content' => Input::get('content'), 'user_id' => Auth::user()->id, 'attachment_id' => $attachment->id]);

        return redirect()->route('post.index');
    }

    /**
     * Display a post in a separate view
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function full(Request $request, $id) {
        return view ('post.full', [
            'post' => Post::where('id', $id)->first()
        ]);
    }


    /**
     * Get the posts in json format
     * @return mixed
     */
    public function getPosts() {
        //simulating a delay
        sleep(2);
        return Response::json($posts = Post::limit(30)->orderBy('created_at', 'DESC')->get());
    }
}

