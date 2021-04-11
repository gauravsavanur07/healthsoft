<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatedUsers;

    protected $redirectTo = RouteServiceProvider::HOME;



    public function _construct(){
        $this->middleware('guest')->except('logout');
    }
}
