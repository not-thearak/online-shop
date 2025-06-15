<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
     #the function we used for login form
    public function loginShow(){
        return view('front-end.auth.login');
    }

    #the function we used for login process  after login form submitted
    public function loginProcess(Request $request){
        // Validate the request data
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password],$request->filled('remember_me'))){
            return redirect()->route('home.index');
        }

        return redirect()->back()->with('error', 'Invalid email or password');
    }

     #the function we used for register form
    public function registerShow(){
        return view('front-end.auth.register');
    }

    #the function we used for register
    public function registerProcess(Request $request){

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|min:9|unique:users,phone',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone'   => $request->phone,
            'role'    => 2
        ]);

        return redirect()->route('customer.login')->with('success', 'Account created successfully!');

    }
}
