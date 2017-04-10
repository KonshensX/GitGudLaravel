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

    /**
     * Index page which display posts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index () {

        $posts = Post::limit(30)->orderBy('created_at', 'DESC')->get();
        return view('post.index', compact('posts'));
    }


    /**
     * Empty as hell for now
     * @param Request $request
     */
    public function add (Request $request) {

    }

    /**
     * Store the post in the database along with the attachment
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store (Request $request) {
        if (!Auth::check()) {
            return response()->json([
                'error' => "You're not logged in, you're not allowed to post"
            ]);
        }
        $post = Post::create(['content' => Input::get('content'), 'user_id' => Auth::user()->id]);
        //dd(Auth::user()->id);
        if (Input::hasFile('file-upload')) {

            $file = Input::file('file-upload');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $filename = md5($filename) . '.' . $extension;
            $file->storePubliclyAs('uploads/attachments', $filename, 'public');
            //Store the attachment and retrieve the id
            $attachment = Attachment::create([
                'post_id' => $post->id,
                'attachment_path' => $filename]);
            //$data['attachment_id'] = $filename;
        }

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
        return Response::json($posts = Post::limit(30)->orderBy('created_at', 'DESC')->get());
    }
}

