<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{

    public function index () {

        $posts = Post::limit(30)->get();

        return view('post.index', compact('posts'));
    }

    public function add (Request $request) {

    }

    public function store (Request $request) {
        //dd(Auth::user()->id);
        $post = Post::create(['content' => Input::get('content'), 'user_id' => Auth::user()->id]);
        return redirect()->route('post.index');
    }
}
