<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StateUsers\StUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


use DB;

class AdminMasterEntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function adminMas()
    {
        return view ('admin.masterentry.adminMaster');
    }

    public function adminDesignation()
    {
        return view ('admin.masterentry.adminDesignationPlace');
    }

    public function adminOrganiser()
    {
        return view ('admin.masterentry.adminOrganiser');
    }

    public function adminAddDistrict()
    {
        return view ('admin.masterentry.adminDistrict');
    }

    public function adminAddBlock()
    {
        return view ('admin.masterentry.adminBlock');
    }

    public function adminAddStaff()
    {
        return view ('admin.masterentry.adminStaff');
    }

    public function adminCreateUser()
    {
        $all_state = DB::table('state_mast')->select('state_nm','state_code')->get();
        // dd($all_state);
        return view ('admin.masterentry.adminCreateUser',compact('all_state'));
    }

    public function addCreateUser(Request $request)
    {
        $request->validate([
            'state_nm' => 'required',
            'state_code' => 'required',
            'user_group' => 'required',
            'user_id' => 'required|string|max:255|unique:state_users_mast',
            'email' => 'required|string|email|max:255|unique:state_users_mast',
            'password' => 'required',
            // 'plain_password' => 'required'
        ],
        [
            'state_nm.required' => 'State name is required',
            'state_code.required' => 'State code is required ',
            'user_group.required' => 'User group is required ',
            'user_id.required' => 'User id is requirfd',
            'email' => 'Email is required',
            'password' => 'Password is required',
        ]);
        $user_group =$request->user_group;
        // dd($user_group);
        $max_users_id = DB::table('state_users_mast')->orderBy('ur_id','desc')->value('ur_id');
       
        if($max_users_id=="")
        {
            $ur_id =  $user_group ."00001";
        }
        else{
  
            $lastp = substr($max_users_id,2,5);
            $lastpp = ++$lastp;
            $last = str_pad($lastpp,5,"0",STR_PAD_LEFT);
            $ur_id  = $user_group . $last;
          }
// dd($ur_id);
          $user = StUsers::create([
            'ur_id'=>$ur_id,
            'state_nm' => $request->state_nm,
            'state_code' => $request->state_code,
            'user_group' => $request->user_group,
            'user_id' => $request->user_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'plain_password' => $request->password,

        ]);
       
        return redirect()->route('add.Creuser')->with('msg','State users has been created successfully');
    }
}
