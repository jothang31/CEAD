<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MeController extends Controller
{
     public function show() {

    	return view('me');

    }
}
