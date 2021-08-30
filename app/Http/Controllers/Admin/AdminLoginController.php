<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
// use App\Models\Admin\Admin;
use DB;
class AdminLoginController extends Controller
{
    public function create()
    {
        return view('admin.adminLogin');
    }

    // public function store(LoginRequest $request)
    //     {
    //         $request->authenticate();
    //         $request->session()->regenerate();
    //         return redirect()->route('admin.dashboard');
    //     }

    public function adminDashboard()
        {
            return view('admin.adminHome');
        }

    public function store(LoginRequest $request)
        {
            $request->authenticate();
            $request->session()->regenerate();
            if(Auth::guard('admin')->user()->user_group == "SU"||'US' and Auth::guard('admin')->user()->admin_status == "T")
                {    
                    return redirect()->route('admin.dashboard');
                }
                else
                {
                    Auth::guard('admin')->logout();
                    $request->session()->invalidate();
    
                    $request->session()->regenerateToken();
    
                    return redirect('/suadmin-login')->with('errmsg','You are not allowed to access this page');
                } 
         
        }
       
       

        public function destroy(Request $request)
        {
            Auth::logout();
    
            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
    
            return redirect('/suadmin-login');
        }
}
