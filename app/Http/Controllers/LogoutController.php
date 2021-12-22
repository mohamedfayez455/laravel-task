<?php

namespace App\Http\Controllers;

class LogoutController
{

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        auth()->logout();
        return redirect()->route('login')->with('success' , 'ننتظر عودتك مرة أخري');
    }

}
