<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class CustomAuthController extends Controller
{
    public function getAdults(){

        return view('customAuth.index');
    }

    public function site(){

        return view('site');
    }

    public function admin(){

        return view('admin');
    }

    public function adminLogin(){

        return view('auth.adminLogin');
    }

    public function adminLoginEnter(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password ])){

            return redirect()->intended('/admin');
        }

        return back()->withInput($request->only('email'));


    }
}
