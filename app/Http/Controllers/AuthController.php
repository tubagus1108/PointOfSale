<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        if (Auth::check()) {
            return redirect()->route('main-dashboard');
        }
        return view('auth.login');
    }
    public function loginPost(Request $request){
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string'
        ];

        $messages = [
            'email.required'        => 'Email is required',
            'email.email'           => 'Invalid email',
            'password.required'     => 'Password is required',
            'password.string'       => 'The password must be a string'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        $data = [
            'email'  => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) {
            return redirect()->route('main-dashboard');

        } else { // false

            //Login Fail
            Session::flash('error', 'Incorrect email or password');
            return redirect()->route('login');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect(route('login'))->with('success', 'Success logout');
    }
}
