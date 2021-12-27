<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController
{

    public function index()
    {
        $title = trans('admin.home');
        $posts_count = Post::count();
        return view('home.index', compact('title','posts_count'));
    }

}
