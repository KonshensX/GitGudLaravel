<?php

namespace App\Http\Controllers;

use App\Following;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TestController extends Controller
{
	public function followed () {	
		// I dunno what am i trying to do, i just wanna get this to work
		// I can make it better later 
		
		dd(Auth::user()->following()->get()[0]->followed_id);
	} 
}
