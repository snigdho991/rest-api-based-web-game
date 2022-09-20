<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        
        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade
        if(Auth::user()->role == "Administrator"){
            $home = config('fortify.home');
        } else if(Auth::user()->role == "Local Administrator"){
            $home = config('fortify.localadmin');
        } else {
            $home = config('fortify.user');
        }
        
        // $home = Auth::user()->role == "Administrator" ? config('fortify.home') : config('fortify.localadmin');
        
        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect($home);
    }

}