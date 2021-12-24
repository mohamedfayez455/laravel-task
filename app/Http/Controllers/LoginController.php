<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class LoginController
{

    public function getLogin()
    {
        return view('login.index');
    }

    public function postLogin(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->validated();
        $remember = request('remember') == 1;
        if(auth()->attempt(['email' => request('email'), 'password' => request('password')],$remember)){
            return redirect()->route('home')->with('success' , trans('admin.login_successfully'));
        }
        return redirect()->route('admin.login')->with('error' , trans('admin.please_check_data'));
    }

}
