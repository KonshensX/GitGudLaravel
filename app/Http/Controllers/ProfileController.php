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

    /**
     * Follow or unfollow a user => toggle the follow
     */
    public function follow (Request $request) {
        $followed_id = Input::get('user_id');
        if (!$followed_id) {
            return redirect()->route('post.index');
        }
        // Check if is already followed 
        $result = Following::where([
            'user_id' => Auth::user()->id,
            'followed_id' => $followed_id,
        ])->get();
        if ($result->count()) {
            foreach ($result as $entity) {
                $entity->delete();
            }
            // I need some sort of a message right here
            return response()->json([
                'message' => 'unfollowed'
            ]);
        } 
        $followed = Following::create([
            'user_id' => Auth::user()->id,
            'followed_id' => $followed_id,
        ]);

        return response()->json([
            'message' => 'followed'
        ]);

    }

    public function following (Request $request, $query) {
        if (!$query) {
            return redirect()->route('post.index');
        }
        $user = User::where('name', $query)->first();
        /*
        $followingArray = Following::where('user_id', $user->id)->get();

        foreach ($followingArray as $key => $value) {
            $profiles[] = User::find($value->followed_id);
        }
        */

        return view('profile.following', [
            'profile' => $user,
          //  'profiles' => $profiles
        ]);
    }

    /**
     * Get the profiles that the user (query) is following as JSON. 
     */ 
    public function getProfiles ($query) {
        $user = User::where('name', $query)->first();
        $followingArray = Following::where('user_id', $user->id)->get();
        $profiles = null;
        foreach ($followingArray as $key => $value) {
            $profiles[] = User::find($value->followed_id);
        }

        return response()->json($profiles);
    }


    public function getUserPosts (Request $request) {
        $user_id = Input::get('id');
        $posts = Post::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        return response()->json($posts);
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
                'query' => $query,
                'profiles' => $profiles
            ]
        );
    }

    /**
     * This return the search result as json 
     */
    public function getSearchResult ($query) {
        if (!$query) {
            return redirect()->route('post.index');
        }
 /*
        $user = User::where('fullname', 'like', '%' . $query .'%')->first();
        $followingArray = Following::where('user_id', $user->id)->get();
        $profiles = null;
        foreach ($followingArray as $key => $value) {
            $profiles[] = User::find($value->followed_id);
        }
       
        return response()->json($profiles);
*/
        $profiles = User::where('fullname', 'like', '%' . $query .'%')->get();
        
        return response()->json($profiles);
    }


    /**
     * Get the followers list 
     */
    public function followers ($query) {
        // Take #1
        // I need to get the followers list by getting rows from following where followed_id == myID
        // And et the user_id 
        return view('profile.followers', [
            'query' => $query
        ]);
    }


    /**
     * Get the followers list 
     */
    public function getFollowers ($query) {
        // Take #1
        // I need to get the followers list by getting rows from following where followed_id == myID
        // And et the user_id 
        if (!Auth::check()) {
            return redirect()->route('post.index');
        }
        
        $user = User::where('name', $query)->first();
        $followingArray = Following::where('followed_id', $user->id)->get();
        $profiles = null;
        foreach ($followingArray as $key => $value) {
            $profiles[] = User::find($value->user_id);
        }

        return response()->json($profiles);
    }
}
