<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\activeInactiveExport;
use PDF;
class AdminFunctionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function adminFunction()
    {
        return view ('admin.function.adminFunction');
    
    }
    public function adminMemAuthentication()
    {
        return view ('admin.function.adminMemAuthentication');
    }

    // public function adminGrOfficeStaff()
    // {
    //     $userid = request('userid1');
    //     // dd( $userid);
    //     $query = DB::table('l_admin') ->orderBy('userid', 'asc');
    //     if($userid != "")
    //     {
    //         $query =  $query ->where('userid', 'like', '%'.$userid.'%');
    //     }
    //     $grstaff = $query->get();
    //     return view ('admin.function.adminGrOfficeStaff',compact('grstaff'));
    // }
    
    public function adminGrOfficeStaffMin()
    {
        $admin_user_id = request('userid1');
        // dd( $admin_user_id);
        $query = DB::table('admin_user') ->orderBy('admin_user_id', 'asc');
        if($admin_user_id != "")
        {
            $query =  $query ->where('admin_user_id', 'like', '%'.$admin_user_id.'%');
        }
        $grstaff = $query->get();
        // dd( $grstaff);

        $permisson_link  =  DB::table('user_permisiion_mast')
        ->orderBy('admin_id', 'asc')
        ->get();

        // dd($permisson_link);
       
        return view ('admin.function.adminGrOfficeStaff',compact('grstaff','permisson_link'));
    }

    public function revokeStaffUp(Request $request)
    {
        $userid = $request->userid;
        $status = $request->status;
       
        // dd(  $userid, $status);
        $query = DB::table('admin_user')->where('admin_user_id',$userid)
            ->update([
                'admin_status' => $status
            ]);
        return back();    
    }
    public function updatePermission(Request $request)
    {
        $admin_id = $request->admin_id;
        $state_per = $request->State;
        $membership_per = $request->Membership;
        $master_per = $request->master_per;
        $mail_per = $request->Mail;
        $function_per = $request->Function;
        
        $query = DB::table('user_permisiion_mast')->where('admin_id',$admin_id)
            ->update([
                'state_per' => $state_per,
                'membership_per'=>$membership_per,
                'master_per'=>$master_per,
                'mail_per'=>$mail_per,
                'function_per'=>$function_per
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
        $media_na = DB::table('fcpm_mast')->where('media_nm','!=','')
        ->select('media_nm')
        ->groupBy('media_nm')
        ->orderBy('media_nm')
        ->get();
        // dd($media_na);
        return view ('admin.function.adminActIntMember',compact('acintive','media_na'));
    }

    public function activeInactiveExcel()
    {
        return Excel::download(new activeInactiveExport, 'statemember.xlsx');
    }

    public function activeInactivePDF()
    {
        $memo_no = request('memo_no_1');
        $mem_nm = request('mem_nm_1');
        $media_nm = request('media_nm_1');
        $mem_stat = request('mem_stat_1');
        // dd($mem_nm);
        // $query = ;
        $query =DB::table('fcpm_mast')->whereIn('mem_stat',['A','D']);
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
        // $query = $query->select('mem_nm','guard_nm','memo_no','media_nm','birth_dt','mem_posting_place','mem_desig','entry_dt','mem_stat','mem_id','profile_pic'); 
        $query = $query->get();
        // dd($query[0]->profile_pic);
      
        $pdf = PDF::loadView('admin.function.activeInactivepdf',compact('query'));
        return $pdf->stream('statemember.pdf');
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

    // public function adminDashboard()
    // {
    //     $user_group = Auth::guard('admin')->user()->user_group;
    //     $admin_id = Auth::guard('admin')->user()->admin_id;
    //     $permisson_link = DB::table('user_permisiion_mast')->where('admin_id', $admin_id)->where('user_group', $user_group)->first();
    //     // dd($permisson_link);
    //     return view('admin.adminHome', compact('permisson_link'));
    // }
}
