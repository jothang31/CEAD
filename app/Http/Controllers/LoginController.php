<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\CeadUser;

class LoginController extends Controller
{
    public function show($userId = '', $message = null) {

    	return view('login', compact('userId', 'message'));

    }

    public function singin(Request $request) {

    	$userId = trim($request->name);
    	$password = $request->password;

        if (!$userId || !$password) {
            
            return $this->show('', 'Debe completar todos los campos!');

        }

    	$user = CeadUser::where([
    					['CU_ID', '=', $userId],
    					['CU_PASSWORD', '=', md5($password)]
    				])->first();

    	if ($user) {

            $request->session()->put('userCode', $user->CU_CODE);
            $request->session()->put('userId', $userId);
            $request->session()->put('userAvatar', $user->CU_NAME_PICTURE_PROFILE);
            $request->session()->put('userProfile', $user->CP_CODE);

    		return redirect('/');
    		
    	} else {

            $message = 'Credenciales invalidas!';

    		return $this->show($userId, $message);

    	}

    }

    public function singout (Request $request) {

        $request->session()->flush();

    	return redirect('login');

    }
}
