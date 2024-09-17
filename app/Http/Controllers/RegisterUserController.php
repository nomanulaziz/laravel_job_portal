<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{
    public function create ()
    {
        return view('auth.register');
    }

    public function store ()
    {
        //validate 
        $attributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required', Password::min(8), 'confirmed'] //matches password with password_confirmation
        ]);

        //create the user
        $user = User::create($attributes);

        //login
        Auth::login($user);

        //redirect to home page
        return redirect('/jobs');
    }
}
