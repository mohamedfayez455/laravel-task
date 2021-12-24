<?php

namespace App\Http\Controllers\Authentication;

class LogoutController
{

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        auth()->logout();
        return redirect()->route('login')->with('success' , trans('admin.come_back_soon'));
    }

}
