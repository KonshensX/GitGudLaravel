<?php

namespace App\Http\Controllers;

use App\Profile;
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
    public function display () {
        $userid = Auth::user()->id;

        return view('profile.display', [
            'profile' => Profile::where('user_id', $userid)->first(),
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
            $profile = Profile::where(['user_id' => Auth::user()->id])->first();
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
        $profiles = Profile::where('fullname', $request->only('search_value'))->get();
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
            'profile' => Profile::find($id)
        ]);
    }

    /**
     * Upload the user informations
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update (Request $request) {
        //Getting the profile to update
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $data = $request->only('fullname', 'about', 'location');
        $profile->fullname = $data['fullname'];
        $profile->location = $data['location'];
        $profile->about = $data['about'];
        $profile->save();
        return redirect()->route('profile.display');
    }
}
