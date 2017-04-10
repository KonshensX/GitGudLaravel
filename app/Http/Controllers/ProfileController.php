<?php

namespace App\Http\Controllers;

use App\Following;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProfileController extends Controller
{
    /**
     * Display the user informations
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function display (Request $request, $name) {
        return view('profile.display', [
            'profile' => User::where('name', $name)->first(),
        ]);
    }

    /**
     * Upload the avatar and store it
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload (Request $request) {
        if (Input::hasFile('avatar')) {
            //dd(Input::file('avatar'));
            /**
             * @var UploadedFile
             *
             */
            $file = Input::file('avatar');

            $filename = $file->getClientOriginalName();
            $extention = $file->getClientOriginalExtension();
            $filename = md5($filename) . '.' . $extention;

            $file->storePubliclyAs('uploads/avatar', $filename, 'public');


            //dd($filename);
            //Get the profile and update the avatar name value
            $profile = User::where(['id' => Auth::user()->id])->first();
            $profile->avatar_name = $filename;
            $profile->save();
            return redirect()->route('profile.display');
        }

    }

    /**
     * Display the form for avatar uploading
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function avatar () {

        return view ('profile.upload');
    }

    /**
     * Search for users using the fullname
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search (Request $request) {
        $query = Input::get('search_value');
        if (!$query) {
            return redirect()->route('post.index');
        }
        $profiles = User::where('fullname', 'like', '%' . $query .'%')->get();
        return view('profile.search', [
                'profiles' => $profiles
            ]
        );
    }

    /**
     * Display the profile of the user for the given id
     *
     * @param Request $request
     * @param $id Integer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function full (Request $request, $id) {
        return view ('profile.full', [
            'profile' => User::find($id)
        ]);
    }

    /**
     * Upload the user informations
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update (Request $request) {
        //Getting the profile to update
        $profile = User::where('id', Auth::user()->id)->first();
        $data = $request->only('fullname', 'about', 'location');
        $profile->fullname = $data['fullname'];
        $profile->location = $data['location'];
        $profile->about = $data['about'];
        $profile->save();
        return redirect()->route('profile.display');
    }

    public function settings () {
        $userid = Auth::user()->id;

        return view('profile.settings', [
            'profile' => User::where('id', $userid)->first(),
        ]);
    }

    public function follow (Request $request) {
        $followed_id = Input::get('user_id');
        if (!$followed_id) {
            return redirect()->route('post.index');
        }

        $followed = Following::create([
            'user_id' => Auth::user()->id,
            'followed_id' => $followed_id,
        ]);

        return response()->json($followed);

    }

    public function following (Request $request, $query) {
        if (!$query) {
            return redirect()->route('post.index');
        }

        $user = User::where('name', $query)->first();
        $followingArray = Following::where('user_id', $user->id)->get();

        foreach ($followingArray as $key => $value) {
            $profiles[] = User::find($value->followed_id);
        }
        

        return view('profile.following', [
            'profile' => $user,
            'profiles' => $profiles
        ]);
    }


    public function getUserPosts (Request $request) {
        sleep(5);
        $user_id = Input::get('id');
        $posts = Post::where('user_id', $user_id)->get();
        return response()->json($posts);
    }
}
