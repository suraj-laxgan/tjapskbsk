<?php

namespace App\Http\Controllers\stateUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\wbApplicant;
use App\Models\Admin\Designation;
use DB;
use Auth;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\stateMemberExport;

class MembershipController extends Controller
{
   public function stateMem()
   {
       return view('stateUser.membership.stateUserMembership');
   }

   public function stateMember()
    {
        $mem_dist = DB::table('district_mast')
                ->orderBy('district_nm')
                ->get();

        $state_name = DB::table('state_mast')
        // ->where('state_code','!=','')
            ->select('state_nm','state_code')
            ->orderBy('state_nm','DESC')
            ->get();
        //   dd($state_name) ; 
        return view ('stateUser.membership.stateUserMemberRegistration', compact('mem_dist','state_name'));
    }

    public function stateMemberRegis(Request $request)
    {
        $sl_nos = DB::table('desig_mast')->where('des_type', $request->des_type)->where('des_nm', $request->mem_desig)->value('sl_no');
        //   dd($sl_nos);

        $max_mem_id = wbApplicant::orderBy('mem_id','desc')->value('mem_id');
        if($max_mem_id =="")
        {
            $mem_id = "00001";
        }
        else{
            $me_id = ++$max_mem_id;
            $mem_id = $me_id;
        }
        // dd( $max_mem_id);

        $state_code = Auth::guard('stateUser')->user()->state_code;
        
        $max_new_id = wbApplicant::orderBy('new_id','DESC')->orWhere('new_id', 'like', '%' . $state_code . '%')->value('new_id');

        $state_nm = DB::table('state_mast')->where('state_code', $state_code)->value('state_nm');
        
        if($max_new_id =='')
        {
            $new_id =  $state_code .'00001';
        }
        else{
            // $ne_id =  ++$max_new_id;
            // $new_id = $ne_id;
            $ne_id = substr($max_new_id,2,5);
            $last_ne_id = ++$ne_id;
            $last1 = str_pad($last_ne_id,5,"0",STR_PAD_LEFT);
            $new_id = $state_code.$last1;
        }
        // dd(  $new_id);

        $max_memo_no = wbApplicant::orderBy('memo_no','desc')->value('memo_no');
        if($max_memo_no =="")
        {
            $memo_no = "SO/00001/2003";
        }
        else{
            $me_no = substr($max_memo_no,2,6);
            $last_memo_no = ++$me_no;
            $last = str_pad($last_memo_no,6,"0",STR_PAD_LEFT);
            $memo_no = 'SO'.$last.'/2003';
        }

        
        $upload = $request->file('profile_pic');
        $filename =$mem_id.'.'. rand(1,99999). '.' . $upload->getClientOriginalExtension();
        $upload->move(public_path('mem_regis_upload'), $filename);

        $mem= new wbApplicant;
        $mem->mem_id=$mem_id;
        $mem->memo_no=$memo_no;
        $mem->new_id=$new_id;
        $mem->state_nm=$state_nm;
        $mem->state_code=$state_code;
        $mem->mem_nm=$request->mem_nm;
        $mem->media_nm=$request->media_nm;
        $mem->entry_dt=$request->entry_dt;
        $mem->contact_no=$request->contact_no;
        $mem->mem_email=$request->mem_email;
        $mem->guard_relatiion=$request->guard_relatiion;
        $mem->guard_nm=$request->guard_nm;
        $mem->gender=$request->gender;
        $mem->mem_cast=$request->mem_cast;
        $mem->birth_dt=$request->birth_dt;
        $mem->mem_quali=$request->mem_quali;
        $mem->mem_add=$request->mem_add;
        $mem->mem_aadhar_no=$request->mem_aadhar_no;
        $mem->mem_pan_no=$request->mem_pan_no;
        $mem->mem_voterid_no=$request->mem_voterid_no;
        $mem->bank_acount_no=$request->bank_acount_no;
        $mem->mem_bank_nm=$request->mem_bank_nm;
        $mem->bnk_ifsc_code=$request->bnk_ifsc_code;
        $mem->des_type=$request->des_type;
        $mem->mem_desig=$request->mem_desig;
        $mem->district=$request->district;
        $mem->mem_posting_place=$request->mem_posting_place;
        $mem->sl_no=$sl_nos;
        $mem->profile_pic=$filename;
        $mem->save();
        return redirect()->route('state.statemember')->with('msg','Member has been resgistered successfully');
        
    }

    public function findDesignationName(Request $r)
    {
        if($r->ajax())
        {
            $des_type = $r->des_type;
            $find_des_type = Designation::where('des_type',$des_type)
                ->orderBy('des_nm')
                ->get();
            
            return $find_des_type;
        }
    }

    public function findDisName(Request $r)
    {
        if($r->ajax())
        {
            $mem_dist = $r->mem_dist;
            $place_of_post = DB::table('block_mast')->where('district_nm',$mem_dist)
                ->orderBy('block_nm')
                ->get();
            
            return $place_of_post;
        }
    }

    public function stateExisMember()
    {
        // dd($state_nm);
        $mem_id = request('mem_id');
        $des_type = request('des_type');
        $district = request('district');
        $des_type =  request('des_type');
        $mem_nm = request('mem_nm');
        $mem_posting_place = request('mem_posting_place');
        $mem_desig = request('mem_desig');
        $media_nm = request('media_nm');
        $guard_nm = request('guard_nm');
        $post_applied_for = request('post_applied_for');
        $memo_no = request('memo_no');
        $state_code = Auth::guard('stateUser')->user()->state_code;

        $query  = wbApplicant::where('mem_stat','A')->where('state_code',$state_code)->whereNotNull('memo_no')
            ->select('mem_id','memo_no','mem_nm','guard_nm','mem_quali','birth_dt','media_nm','mem_desig','mem_posting_place');
       
        $all_memid = '';
  
            if($mem_id != '')
            {
            $query = $query->where('mem_id', 'like', '%' . $mem_id . '%');
            }

            if($des_type != '')
            {
                $query = $query->where('des_type', 'like', '%' . $des_type . '%');
            }

            if($district != '')
            {
                $query = $query->where('district', 'like', '%' . $district . '%');  
            }

            if($des_type != '')
            {
            $query = $query->where('des_type', 'like', '%' . $des_type . '%');
            }
            if($mem_nm != '')
            {
              $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
            }

            if($mem_posting_place != '')
            {
                $query = $query->where('mem_posting_place', 'like', '%' . $mem_posting_place . '%');
            }
           
            if($mem_desig != '')
            {
              $query = $query->where('mem_desig', 'like', '%' . $mem_desig . '%');
            }

            if($media_nm != '')
            {
                $query = $query->where('media_nm','like', '%' . $media_nm . '%');
            }

            if($guard_nm != '')
            {
                $query = $query->where('guard_nm', 'like', '%' . $guard_nm . '%');
            }

            if($post_applied_for != '')
            {
              $query = $query->where('post_applied_for', 'like', '%' . $post_applied_for . '%');
            }

            if($memo_no != '')
            {
              $query = $query->where('memo_no', 'like', '%' . $memo_no . '%');
            }
            
            // $query =  $query->select('ques_sl_no','application_no');
            $wbappli= $query->paginate(100);
            $wbappli_total= count($wbappli);
            // dd($wbappli_total);
            $wbappli->appends([
                'mem_id' => $mem_id,
                'district' => $district,
                'des_type' => $des_type,
                'des_type' => $des_type,
                'mem_nm' =>$mem_nm,
                'mem_posting_place' =>$mem_posting_place,
                'mem_desig' =>$mem_desig,
                'media_nm' =>$media_nm,
                'guard_nm' => $guard_nm,
                'post_applied_for' =>$post_applied_for,
                'memo_no' => $memo_no
            ]);

            $mem_dist = DB::table('district_mast')->orderBy('district_nm')->get();

            $block_name = DB::table('block_mast')->orderBy('block_nm')->get();

            $media_na = DB::table('fcpm_mast')->where('media_nm','!=','')
                ->select('media_nm')
                ->groupBy('media_nm')
                ->orderBy('media_nm')
                ->get();
           
        return view ('stateUser.membership.stateUserExisMember',compact('wbappli','wbappli_total','mem_dist','block_name','media_na'));
    }

    public function statememView($id)
    {
        // $id = request('mem_id');
        $mem_view = DB::table('fcpm_mast')->where('mem_id', $id)
            ->select('mem_nm','guard_nm','profile_pic','mem_posting_place','mem_desig','entry_dt','memo_no')
            ->first();
        // dd( $mem_view);
        return view('stateUser.membership.stateUserExisMemSmallView',compact('mem_view'));
    }

    public function stateMemEdit($id)
    {
        // $id = request('mem_id');
        $mem_dist = DB::table('district_mast')
        ->orderBy('district_nm')
        ->get();
        
        $mem_edit = DB::table('fcpm_mast')->where('mem_id', $id)
            ->select('state_code','state_nm','mem_nm','media_nm','entry_dt','contact_no','mem_email','guard_nm','gender','mem_cast','birth_dt','mem_quali','guard_relatiion','mem_add','mem_aadhar_no','mem_pan_no','mem_voterid_no','bank_acount_no','mem_bank_nm','bnk_ifsc_code','des_type','profile_pic','mem_posting_place','mem_desig','memo_no','mem_id','district')
            ->first();
            // $mem_id=request('mem_id');
            // dd( $mem_id);
        // dd( $mem_edit);
        return view('stateUser.membership.stateUserExisMemEdit',compact('mem_edit','mem_dist'));
    }

    public function stateMemUpload(Request $request)
    {
        $state_code = Auth::guard('stateUser')->user()->state_code;
        $mem_id = $request->mem_id;

        $sl_nos = DB::table('desig_mast')->where('des_type', $request->des_type)->where('des_nm', $request->mem_desig)->value('sl_no');

        $pic=wbApplicant::where('mem_id', $request->mem_id)->where('state_code', $state_code)->select('mem_id','profile_pic')->first();

            if($request->file('profile_pic') != "" && $pic->profile_pic != "")
            {
            unlink(public_path('mem_regis_upload/'.$pic->profile_pic));
            $upload = $request->file('profile_pic');
            $filename =$mem_id.'.'. rand(1,99999). '.' . $upload->guessExtension();
            $upload->move(public_path('mem_regis_upload'), $filename);
            }
            elseif($request->file('profile_pic') != "")
            {
                $upload = $request->file('profile_pic');
                $filename =$mem_id.'.'. rand(1,99999). '.' . $upload->guessExtension();
                $upload->move(public_path('mem_regis_upload'), $filename);
            }
            // elseif($request->file('profile_pic') == "")
            // {
            //     $upload = $request->file('profile_pic');
            //     $filename =$mem_id.'.'. rand(1,99999). '.' . $upload->guessExtension();
            //     $upload->move(public_path('mem_regis_upload'), $filename);
            // }
            elseif($request->file('profile_pic') == "")
            {
                $filename = $pic->profile_pic;
            }

            $pic->profile_pic=$filename;
            $pic->save();

        $editmem=wbApplicant::where('mem_id', $request->mem_id)->where('state_code', $state_code)
            ->select('mem_id','memo_no','new_id','state_code','state_nm','mem_nm','media_nm','entry_dt','contact_no','mem_email','guard_nm','gender','mem_cast','birth_dt','mem_quali','guard_relatiion','mem_add','mem_aadhar_no','mem_pan_no','mem_voterid_no','bank_acount_no','mem_bank_nm','bnk_ifsc_code','des_type','profile_pic','mem_posting_place','mem_desig','sl_no')
            ->first()->update([ 
            'mem_id' => $request->mem_id,
            'mem_nm' => $request->mem_nm,
            'media_nm' => $request->media_nm,
            'entry_dt' => $request->entry_dt,
            'contact_no' => $request->contact_no,
            'mem_email' => $request->mem_email,
            'guard_relatiion' => $request->guard_relatiion,
            'guard_nm' => $request->guard_nm,
            'gender' => $request->gender,
            'mem_cast' => $request->mem_cast,
            'birth_dt' => $request->birth_dt,
            'mem_quali' => $request->mem_quali,
            'mem_add' => $request->mem_add,
            'mem_aadhar_no' => $request->mem_aadhar_no,
            'mem_pan_no' => $request->mem_pan_no,
            'mem_voterid_no' => $request->mem_voterid_no,
            'bank_acount_no' => $request->bank_acount_no,
            'mem_bank_nm' => $request->mem_bank_nm,
            'bnk_ifsc_code' => $request->bnk_ifsc_code,
            'des_type' => $request->des_type,
            'mem_desig' => $request->mem_desig,
            'district' => $request->district,
            'mem_posting_place' => $request->mem_posting_place,
            'sl_no'=> $sl_nos
            // 'profile_pic' => $request->profile_pic
        ]);
    //    dd( $editmem);
        return redirect()->route('state.adminexmember')->with('msg','Member has been updated  successfully');
    }

    public function wbExcel()
    {
        return Excel::download(new stateMemberExport, 'statemember.xlsx');
    }

    public function generatePDF()
    {
        $des_type = request('des_type');
        $district = request('district');
        $memo_no = request('memo_no');
        $mem_nm = request('mem_nm');
        $mem_posting_place = request('mem_posting_place');
        $post_applied_for = request('post_applied_for');
        $mem_desig = request('mem_desig');
        $media_nm = request('media_nm');
        $guard_nm = request('guard_nm');

        $state_code = Auth::guard('stateUser')->user()->state_code;

        $query =  wbApplicant::where('mem_stat','A')->where('state_code',$state_code)->whereNotNull('memo_no')
            ->select('state_code','state_nm','mem_nm','media_nm','entry_dt','contact_no','mem_email','guard_nm','gender','mem_cast','birth_dt','mem_quali','guard_relatiion','mem_add','mem_aadhar_no','mem_pan_no','mem_voterid_no','bank_acount_no','mem_bank_nm','bnk_ifsc_code','des_type','profile_pic','mem_posting_place','mem_desig','memo_no','mem_id');
           
          if($des_type != '')
          {
            $query = $query->where('des_type', 'like', '%' . $des_type . '%');
          }

          if($district != '')
          {
            $query = $query->where('district', 'like', '%' . $district . '%');
          }

          if($memo_no != '')
          {
            $query = $query->where('memo_no', 'like', '%' . $memo_no . '%');
          }

          if($mem_nm != '')
          {
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
          }

          if($mem_posting_place != '')
          {
            $query = $query->where('mem_posting_place', 'like', '%' . $mem_posting_place . '%');
          }

          if($post_applied_for != '')
          {
            $query = $query->where('post_applied_for', 'like', '%' . $post_applied_for . '%');
          }
          
          if($mem_desig != '')
          {
            $query = $query->where('mem_desig', 'like', '%' . $mem_desig . '%');
          }

          if($media_nm != '')
          {
            $query = $query->where('media_nm', 'like', '%' . $media_nm . '%');
          }

          if($guard_nm != '')
          {
            $query = $query->where('guard_nm', 'like', '%' . $guard_nm . '%');
          }
        
            $query = $query->get();
     
    //   dd($mem_down);
       $pdf = PDF::loadView('stateUser.membership.pdfState',compact('query'));
    //    dd($pdf);  
      //  return $pdf->download('E-Verification.pdf');  
        return $pdf->stream('statemember.pdf');
    }

}
