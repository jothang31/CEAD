<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function show(Request $request) {

    	$userAvatar = $request->session()->get('userAvatar');
    	$userProfile = $request->session()->get('userProfile');
    	$userId = $request->session()->get('userId');

    	return view('home', compact('userId', 'userAvatar', 'userProfile'));

    }
}
