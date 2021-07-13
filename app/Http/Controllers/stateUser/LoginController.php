<?php

namespace App\Http\Controllers\stateUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\stateUser\LoginRequest;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{ 
    public function create()
    {
        return view('stateUser.stateUserLogin');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect('state/dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/state-login');
    }
}
