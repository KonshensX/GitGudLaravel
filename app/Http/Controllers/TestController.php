<?php

namespace App\Http\Controllers;

use App\Following;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TestController extends Controller
{
	public function followed () {	
		dd(Auth::user()->isFollowed);
	} 
}
