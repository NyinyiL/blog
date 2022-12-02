<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function create() {
        return view('auth.register') ;
    }
    
    public function store() {
        // validate
        $data = request()->validate([
            'name' => ["required" , 'max:255', 'min:3'] ,
            'username' => ["required" , 'max:255', 'min:3', Rule::unique('users', 'username')] ,
            'email' => ["required" , 'email' , Rule::unique('users', 'email')] ,
            'password' => ["required" , 'min:8'] ,
        ]) ;

        $user = User::create($data) ;
        auth()->login($user) ;
        return redirect('/') ;
    }

    // login
    public function login() {
        return view('auth.login') ;
    }

    // post_login
    public function post_login() {
        $data = request()->validate([
            'email' => ['required', 'email', 'max:255', Rule::exists('users', 'email')] ,
            'password' => ['required', 'min:8', 'max:255'] ,
        ], [
            'email.required' => 'Your email is wrong or invalid',
            'password.min' => 'Password should be more than 8 charaters' ,
        ]) ;

        // auth attmept
        if(auth()->attempt($data)) {
            if(auth()->user()->is_admin) {
                return redirect('/admin/blogs') ;
            } else {
                return redirect('/') ;
            }
        } else {
            return redirect()->back()->withErrors([
                'email' => 'Users not found'
            ]) ;
        }
    }

    // Logout
    public function logout() {
        auth()->logout() ;
        return redirect('/') ;
    }
}
