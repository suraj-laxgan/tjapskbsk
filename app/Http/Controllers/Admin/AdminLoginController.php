<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
// use App\Models\Admin\Admin;
class AdminLoginController extends Controller
{
    public function create()
    {
        return view('admin.adminLogin');
    }

    public function store(LoginRequest $request)
        {
            $request->authenticate();
    
            $request->session()->regenerate();
    
            return redirect('admin/dashboard');
        }

        public function destroy(Request $request)
        {
            Auth::logout();
    
            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
    
            return redirect('/suadmin-login');
        }
}
