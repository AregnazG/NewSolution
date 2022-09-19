<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{

    public function index()
    {

        return view('auth.login');

    }

    public function postLogin(Request $request)
    {

        $request->validate([

            'username' => 'required|max:10',
            'password' => 'required|min:6|max:8'

        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', '=', $username)->first();

        if($user->password == $password) {

            Auth::login($user);

            $request->session()->put('lifeTime', Carbon::now()->timestamp);

            return redirect('profile');

        }

        return redirect('login')->with('succes', 'Login details are not valid');

    }

    public function profile()
    {

        return view('auth.profile');

    }

}
