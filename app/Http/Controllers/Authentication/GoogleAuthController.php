<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{

    private $userRepository;
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    // Redirect the user to the Google authentication page.
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Obtain the user information from Google.
    public function callback(): \Illuminate\Http\RedirectResponse
    {
        try {
            $social_user = Socialite::driver('google')->user();
            // First we check if the user has used Google before to log in, we make him a login user immediately
            $user = User::where('google_id', $social_user->id)->first();
            if ($user) {
                Auth::login($user);
            } else {
                // else add the user to the database and make it a login user
                $created_user = $this->userRepository->storeUser($social_user);
                Auth::login($created_user);
            }
            return redirect()->route('home')->with('success',trans('admin.login_successfully'));
        } catch (\Exception $exception) {
            return redirect()->route('login')->with('error',trans('admin.try_again'));
        }
    }

}
