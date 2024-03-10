<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //validate data
        $request->validate([
            'email'=>'required',
            'password'=>"required"

        ]);
        //login code
        if(\Auth::attempt($request->only('email','password'))){
            $user = \Auth::user();
    
            if($user->role==='admin')
            {
            return redirect()->route('products.adminIndex');
            }
            else{
                return redirect()->route('products.index');
            }
            
        }
      return redirect()->route('login')->withError('Invalid email or password');
        

    }
    public function register_view()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        //validate

        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users|email',
            'password'=>'required|confirmed'

        ]);
    //    save in users table
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>\Hash::make($request->password)
        ]);

        //if registered move to landing page no need to login

        if(\Auth::attempt($request->only('email','password'))){
            
            \Log::info('User authenticated: ' . $request->email);
            return redirect()->route('products.index');
        }
        else
        {
            \Log::info('Authentication failed: ' . $request->email);

       return redirect()->route('register')->withErrors('Error');
        }
        
        
    }
    public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return redirect('') ;

    }
}
