<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
       //dd(Hash::make('password'));

        return view('auth.login');
    }

    public function store(Request $request)
    {

        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',  // You can adjust the minimum password length
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if the 'remember' checkbox is checked
        $remember = !empty($request->remember) ? true : false;

        // Attempt to authenticate the user
        if (Auth::attempt(
            [
                'email'    => $request->email,
                'password' => $request->password,
            ], $remember)
        ) {
            return redirect('admin/dashboard');
        } else {
            return redirect()->back()->with('error', "Please enter correct email and password");  // Use a translatable error message
        }
    }
}
