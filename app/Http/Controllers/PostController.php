<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{

    public function index () {

        $posts = Post::get();

        return view('post.index', compact('posts'));
    }

    public function add (Request $request) {
        return view('post.add');
    }

    public function store (Request $request) {
        if (Input::hasFile('avatar')) {
            /**
             * @var UploadedFile
             */
            $file = Input::file('avatar');
            $file->move('./uploads/', md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension());
        }
    }
}
