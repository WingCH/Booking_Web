<?php

namespace App\Http\Controllers;

use App\User as UserEloquent;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $login_user = UserEloquent::where('email', $request->input('email'))->where('password', $request->input('password'))->first();
        if (isset($login_user)) {
            Auth::login($login_user);
            return Redirect::action('HomeController@index');
        } else {
            return "account or password incorrect";
        }
    }

    public function register(Request $request)
    {
        // Debugbar::error($request->input('name'));
        $new_user           = new UserEloquent;
        $new_user->name     = $request->input('name');
        $new_user->email    = $request->input('email');
        $new_user->password = $request->input('password');
        $new_user->save();
        Auth::login($new_user);
        return Redirect::action('HomeController@index');
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::action('HomeController@index');
    }

}
