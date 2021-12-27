<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FallBackController extends Controller
{

    public function __invoke(Request $request)
    {
        return view('fallback.index');
    }
}
