<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

        // Check if input is email or username
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        // Attempt login
        if (Auth::attempt([
            $fieldType => $request->login,
            'password' => $request->password
        ], $remember)) {

            $request->session()->regenerate();



            if (Auth::user()->role === 'admin') {
                return redirect()->to('/admin-dashboard')
                    ->with('success', 'Login successful!');
            } elseif (Auth::user()->role === 'staff') {
                return redirect()->to('/staff-dashboard')
                    ->with('success', 'Login successful!');
            } else {
                return back()->withErrors([
                    'login' => 'Unidentified Access.'
                ])->withInput();
            }
        }
        return back()->withErrors([
            'login' => 'Invalid credentials.'
        ])->withInput();
    }



    public function logout(Request $request)
    {
        Auth::logout(); // log user out

        $request->session()->invalidate(); // invalidate session
        $request->session()->regenerateToken(); // regenerate CSRF token

        return redirect('/')->with('success', 'Logged out successfully!');
    }
}
