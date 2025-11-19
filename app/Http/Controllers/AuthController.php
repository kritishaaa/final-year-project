<?php

namespace App\Http\Controllers;

use App\Enums\ActivityEvents;
use App\Facades\ActivityLogFacade;
use App\Facades\GlobalFacade;
use App\Facades\ImageServiceFacade;
use App\Http\Requests\RegisterCustomerRequest;
use App\Traits\HelperDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Src\Customers\Models\Customer;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
  

    public function login()
{
    if (\auth()->check()) {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'courier') {
            return redirect()->route('courier.dashboard');
        } else {
            // Optional: redirect other roles or logout
            return redirect()->route('home');
        }
    }

    return view('admin.auth.login');
}


    public function showRegisterForm()
    {
        return view('admin.register'); 
    }

    public function forgotPassword()
    {
        return view('admin.forgot-password');
    }

   

    public function authenticate(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::guard('web')->user();

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        } elseif ($user->role === 'courier') {
            return redirect()->intended(route('courier.dashboard'));
        } else {
            // Optional: logout and show error for unknown roles
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Unauthorized role.']);
        }
    }

    return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
}


    public function logout(Request $request)
    {
        
        return redirect()->route('login');
    }

    function changePassword()
    {
        return view('Profile::customerChangePassword');
    }
}
