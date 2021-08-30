<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class CommonController extends Controller
{
    static function permissonLink(){
        $user_group = Auth::guard('admin')->user()->user_group;
        $admin_id = Auth::guard('admin')->user()->admin_id;
        $permisson_link = DB::table('user_permisiion_mast')->where('admin_id', $admin_id)->where('user_group', $user_group)->first();
        return $permisson_link;
    }
    static function permissonLink_2($admin_id,$user_group){
        $permisson_link = DB::table('user_permisiion_mast')->where('admin_id', $admin_id)->where('user_group', $user_group)->first();
        return $permisson_link;
    }
    
}
