<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        if(Auth::check()){
            if(Auth::user()->role == 1){
                return redirect()->route('dashboard.index');
            }else{
                return redirect()->route('category.index');
            }
        }else{
            return view('back-end.login');
        }

    }
    public function logout(){
        Auth::logout();
        return redirect()->route('auth.index')->with('success', 'Logout successful');
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        if ($validator->passes()) {

            $credentials = $request->only('email', 'password');

            if(Auth::attempt($credentials)){
                if(Auth::user()->role == 1){
                    // Authentication passed...
                    return redirect()->route('dashboard.index')->with('success', 'Welcome, ' . Auth::user()->name . '! You Login successful');
                }else{
                    return redirect()->back()->with('error', 'You are not an Admin');
                }

            } else {
                return redirect()->back()->with('error', 'worng email or password');
            }
        } else {
           return redirect()->back()->withErrors($validator->errors())->withInput();
        }

    }
}
