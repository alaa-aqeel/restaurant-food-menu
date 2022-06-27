<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    function getCredentials($request)
    {
        return $request->only(['username', 'password']);
    }

    /**
     * Login user 
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) 
    {

        $credentials = $this->getCredentials($request);


        if (auth()->attempt($credentials)) {
            
            if ($request->isJson()){

                $token = auth()
                    ->user()
                    ->createToken('Auth Token')
                    ->plainTextToken;

                return response()->json(['token' => $token], 200);
            }

            $request->session()->regenerate();
            return redirect()->intended('dashboard');;
        }

        $errors = ['login_error' => __('messages.login_invalid_data')];

        if ($request->isJson()){
            
            return response()->json($errors, 401);
        }

        return back()->withErrors($errors);
    }
}
