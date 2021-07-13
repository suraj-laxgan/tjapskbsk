<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminFunctionController extends Controller
{
    public function adminFunction()
    {
        return view ('admin.function.adminFunction');
    
    }
    public function adminMemAuthentication()
    {
        return view ('admin.function.adminMemAuthentication');
    }

    public function adminGrOfficeStaff()
    {
        return view ('admin.function.adminGrOfficeStaff');
    }

    public function adminActIntMember()
    {
        return view ('admin.function.adminActIntMember');
    }
}
