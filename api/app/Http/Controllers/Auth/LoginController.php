<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
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
     * @return \App\Http\Resources\AccountResource|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request) 
    {

        $credentials = $this->getCredentials($request);


        if (auth()->attempt($credentials)) {
            
            if ($request->isJson()){

                $user = auth()->user();
                $token = $user
                            ->createToken('Auth Token')
                            ->plainTextToken;


                $resource = new AccountResource($user);
                $resource->additional([
                    'token' => $token
                ]);

                return $resource;
            }

            $request->session()->regenerate();
            return redirect()->intended('dashboard');;
        }

        $errors = ['message' => __('messages.login_invalid_data')];

        if ($request->isJson()){
            
            return response()->json($errors, 401);
        }

        return back()->withErrors($errors);
    }
}
