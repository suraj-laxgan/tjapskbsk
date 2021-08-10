<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

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
        $userid = request('userid1');
        // dd( $userid);
        $query = DB::table('l_admin') ->orderBy('userid', 'asc');
        if($userid != "")
        {
            $query =  $query ->where('userid', 'like', '%'.$userid.'%');
        }
        $grstaff = $query->get();
        return view ('admin.function.adminGrOfficeStaff',compact('grstaff'));
    }

    public function revokeStaffUp(Request $request)
    {
        $userid = $request->userid;
        $status = $request->status;
        // dd(  $userid, $status);
        $query = DB::table('l_admin')->where('userid',$userid)
            ->update([
                'status' => $status
            ]);
        return back();    
    }

    public function adminActIntMember()
    {
       
        $memo_no = request('memo_no_1');
        $mem_nm = request('mem_nm_1');
        $media_nm = request('media_nm_1');
        $mem_stat = request('mem_stat_1');
        // dd($mem_nm);
        $query = DB::table('fcpm_mast');
        $query = $query->whereIn('mem_stat',['A','D']);
            // ->get();
            if($memo_no != '')
            {
                $query = $query->where('memo_no', 'like', '%'.$memo_no.'%');
            }
           
            if($mem_nm != '')
            {
               
                $query = $query->where('mem_nm', 'like', '%'.$mem_nm.'%');
                
            }
            
            if($media_nm != '')
            {
                $query = $query->where('media_nm', 'like', '%'.$media_nm.'%');
            }
            if($mem_stat != '')
            {
                $query = $query->where('mem_stat', $mem_stat);
            }
        $query = $query->select('mem_nm','guard_nm','memo_no','media_nm','birth_dt','mem_posting_place','mem_desig','entry_dt','mem_stat','mem_id'); 
        $acintive =  $query->paginate(100);
        // $ujde = count( $acintive );
        // dd($acintive);
        return view ('admin.function.adminActIntMember',compact('acintive'));
    }

    public function revokeMemberUp(Request $request)
    {
        // dd($request->mem_stat, $request->mem_id);
        $mem_id =  $request->mem_id;
        $mem_stat =  $request->mem_stat;
        $query = DB::table('fcpm_mast')->where('mem_id',$mem_id)
            ->update([
                'mem_stat' => $mem_stat
            ]);
        return back();
    }
}
