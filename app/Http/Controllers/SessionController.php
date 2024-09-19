<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create ()
    {
        return view('auth.login');
    }

    public function store ()
    {
        // validate
        // no need to catch these errors in the view 
        // laravel will do it automatically
        $attributes = request()->validate([
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required']
        ]);

        // attempt to login the user
        // no need to catch these errors in the view 
        // laravel will do it automatically
        if( !Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.',
            ]);
        }

        //regenerate the session token
        request()->session()->regenerate();

        //redirect
        return redirect('/jobs');
    }

    public function destroy ()
    {
        Auth::logout();

        return redirect('/');
    }
}
