<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\wbApplicant;
use App\Models\Admin\webUser;
use App\Models\Admin\Designation;
use DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\allMemberExport;
use App\Exports\allMemberQueryExport;
use Illuminate\Support\Collection;

class AdminMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function adminMemberMain()
    {
        return view ('admin.membership.adminMembership');
    }

    public function adminMember()
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
        return view ('admin.membership.adminMembeRegistration', compact('mem_dist','state_name'));
    }
    
    public function adminMemberRegis(Request $request)
    {
        $validated = $request->validate([
            // 'state_code' => 'required|max:2',
            'state_nm' => 'required',
            'mem_nm' => 'required',
            'media_nm' => 'required',
            'entry_dt' => 'required',
            'contact_no' => 'required | integer',
            'mem_email' => 'required|string|email|max:255|unique:fcpm_mast',
        ],
        [
            'state_nm.required' => 'State Name is required ',
            'mem_nm.required' => 'Member Name is required ',
            'media_nm.required' => 'Media Name is requirfd',
            'entry_dt.required' => 'Entry Date is required',
            'contact_no.required' => 'Contact No is required',
            'mem_email.required' => 'Email is required'
      ]);
    
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

        $state_code =$request->state_nm;
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
        $filename = $mem_id. '.' . $upload->getClientOriginalExtension();
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
        return redirect()->route('ad.adminmember')->with('msg','Member has been resgistered successfully');
        
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
    
    public function findStateName(Request $r)
    {
        if($r->ajax())
        {
            $state_nm = $r->state_nm;
            $state = DB::table('state_mast')->where('state_nm',$state_nm)
                ->orderBy('state_nm')
                ->get();
            
            return $state;
        }
    }

    // ************ Existing Member Search ****************

    public function adminExisMember()
    {
        // dd($state_nm);
        $mem_id = request('mem_id');
        $memo_no = request('memo_no');
        $des_type = request('des_type');
        $district = request('district');
        $des_type =  request('des_type');
        $mem_nm = request('mem_nm');
        $mem_posting_place = request('mem_posting_place');
        $mem_desig = request('mem_desig');
        $media_nm = request('media_nm');
        $guard_nm = request('guard_nm');
        $post_applied_for = request('post_applied_for');
        
        // // $new = DB::table('fcpm_mast')->where('mem_stat','A')->where('reg_status','new');
        $query  = wbApplicant::where('mem_stat','A')->where('reg_status','!=','new')
        ->whereNotNull('memo_no')
            ->select('mem_id','memo_no','mem_nm','guard_nm','mem_quali','birth_dt','media_nm','mem_desig','mem_posting_place');
        // dd( $query);
                        // $query = $query->where('reg_status',['new']);
        $all_memid = '';
  
            if($mem_id != '')
            {
            $query = $query->where('mem_id', 'like', '%' . $mem_id . '%');
            }

            if($memo_no != '')
            {
            $query = $query->where('memo_no', 'like', '%' . $memo_no . '%');
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
            
            // $query =  $query->select('ques_sl_no','application_no');
            $wbappli= $query->paginate(100);
            $wbappli_total= count($wbappli);
            // dd($wbappli_total);
            $wbappli->appends([
                'mem_id' => $mem_id,
                'memo_no'=>$memo_no,
                'district' => $district,
                'des_type' => $des_type,
                'des_type' => $des_type,
                'mem_nm' =>$mem_nm,
                'mem_posting_place' =>$mem_posting_place,
                'mem_desig' =>$mem_desig,
                'media_nm' =>$media_nm,
                'guard_nm' => $guard_nm,
                'post_applied_for' =>$post_applied_for
            ]);
           
            $mem_dist = DB::table('district_mast')->orderBy('district_nm')->get();

            $block_name = DB::table('block_mast')->orderBy('block_nm')->get();

            $media_na = DB::table('fcpm_mast')->where('media_nm','!=','')
                ->select('media_nm')
                ->groupBy('media_nm')
                ->orderBy('media_nm')
                ->get();
           
        return view ('admin.membership.adminExisMember',compact('wbappli','wbappli_total','mem_dist','block_name','media_na'));
    }

    public function memView($id)
    {
        // $id = request('mem_id');
        $mem_view = DB::table('fcpm_mast')->orWhere('mem_id', 'like', '%' . $id . '%')
            ->select('mem_id','mem_nm','guard_nm','profile_pic','mem_posting_place','mem_desig','entry_dt','memo_no')
            ->first();
        // dd( $mem_view);
        return view('admin.membership.adminExisMemSmallView',compact('mem_view'));
    }
    
    public function memEdit($id)
    {
        // $id = request('mem_id');
        $mem_dist = DB::table('district_mast')
        ->orderBy('district_nm')
        ->get();

        $state_name = DB::table('state_mast')
        // ->where('state_code','!=','')
            ->select('state_nm','state_code')
            ->orderBy('state_nm','DESC')
            ->get();

        // dd( $mem_dist);
        $mem_edit = DB::table('fcpm_mast')->orWhere('mem_id', 'like', '%' . $id . '%')
            ->select('state_code','state_nm','mem_nm','media_nm','entry_dt','contact_no','mem_email','guard_nm','gender','mem_cast','birth_dt','mem_quali','guard_relatiion','mem_add','mem_aadhar_no','mem_pan_no','mem_voterid_no','bank_acount_no','mem_bank_nm','bnk_ifsc_code','des_type','profile_pic','mem_posting_place','mem_desig','memo_no','mem_id','district')
            ->first();
            // $mem_id=request('mem_id');
            // dd( $mem_id);
        // dd( $mem_edit);
        return view('admin.membership.adminExisMemEdit',compact('mem_edit','mem_dist','state_name'));
    }

    public function adminMemUpload(Request $request)
    {
        $mem_id = $request->mem_id;

        $sl_nos = DB::table('desig_mast')->where('des_type', $request->des_type)->where('des_nm', $request->mem_desig)->value('sl_no');

        $pic=wbApplicant::where('mem_id', $request->mem_id)->select('mem_id','profile_pic')->first();

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
            
            elseif($request->file('profile_pic') == "")
            {
                $filename = $pic->profile_pic;
            }

            $pic->profile_pic=$filename;
            $pic->save();

        $editmem=wbApplicant::where('mem_id', $request->mem_id)
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
        return redirect()->route('ad.adminexmember')->with('msg','Member has been updated  successfully');
    }

    public function memExcel()
    {
        return Excel::download(new allMemberExport, 'statemember.xlsx');
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


        $query =  wbApplicant::where('mem_stat','A')->whereNotNull('memo_no')
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
       $pdf = PDF::loadView('admin.membership.pdfMem',compact('query'));
    //    dd($pdf);  
      //  return $pdf->download('E-Verification.pdf');  
        return $pdf->stream('statemember.pdf');
    }
    public function adminMemberQuery()
    {
       
        $mem_id = request('mem_id');
        $mem_stat = request('mem_stat');
        $memo_no = request('memo_no');
    //    dd($memo_no);

        $query =  wbApplicant::where('mem_stat','A')->where('reg_status','!=','new')
        ->select('mem_id','memo_no','profile_pic','mem_desig','birth_dt','mem_posting_place','mem_nm','media_nm');
        // dd( $query);
      
        $all_memid = '';
  
            if($mem_id != '')
            {
            $query = $query->where('mem_id', 'like', '%' . $mem_id . '%');
            }

            if($mem_stat != '')
            {
            $query = $query->where('mem_stat', 'like', '%' . $mem_stat . '%');
            }
            if($memo_no == 'M')
            {
                $query = $query->where('memo_no', '');
            }
            elseif ($memo_no == 'P') {
                $query = $query->where('profile_pic', '');
            }
            elseif ($memo_no == 'D') {
                $query = $query->where('mem_desig', '');
            }
            elseif ($memo_no == 'POP') {
                $query = $query->where('mem_posting_place', '');
            }
            elseif ($memo_no == 'DOB') {
                $query = $query->where('birth_dt', '');
            }
            $mem_query= $query->paginate(100);
            $mem_query_total= count($mem_query);
            // dd($mem_query_total);
            $mem_query->appends([
                'mem_id' => $mem_id,
                'mem_stat' => $mem_stat,
                'memo_no' => $memo_no,
               
            ]);
   
        return view ('admin.membership.adminMemberQuery',compact('mem_query','mem_query_total'));
    }

    public function memQueryExcel()
    {
        return Excel::download(new allMemberQueryExport, 'member.xlsx');
    }

    public function memQueryView($id)
    {
        // $id = request('mem_id');
        $mem_details = DB::table('fcpm_mast')->orWhere('mem_id', 'like', '%' . $id . '%')
            ->select('mem_id','mem_nm','guard_nm','profile_pic','mem_posting_place','mem_desig','entry_dt','memo_no')
            ->first();
        // dd( $mem_details);
        return view('admin.membership.adminMemberQuerySmallView',compact('mem_details'));
    }

    public function memQueryEdit($id)
    {
        // $id = request('mem_id');
        $mem_dist = DB::table('district_mast')
        ->orderBy('district_nm')
        ->get();

        $state_name = DB::table('state_mast')
        // ->where('state_code','!=','')
            ->select('state_nm','state_code')
            ->orderBy('state_nm','DESC')
            ->get();

        // dd( $mem_dist);
        $mem_edit = DB::table('fcpm_mast')->orWhere('mem_id', 'like', '%' . $id . '%')
            ->select('state_code','state_nm','mem_nm','media_nm','entry_dt','contact_no','mem_email','guard_nm','gender','mem_cast','birth_dt','mem_quali','guard_relatiion','mem_add','mem_aadhar_no','mem_pan_no','mem_voterid_no','bank_acount_no','mem_bank_nm','bnk_ifsc_code','des_type','profile_pic','mem_posting_place','mem_desig','memo_no','mem_id','district')
            ->first();
            // $mem_id=request('mem_id');
            // dd( $mem_id);
        // dd( $mem_edit);
        return view('admin.membership.adminMemberQueryEdit',compact('mem_edit','mem_dist','state_name'));
    }

    public function adminMemQueryUpload(Request $request)
    {
        $mem_id = $request->mem_id;

        $sl_nos = DB::table('desig_mast')->where('des_type', $request->des_type)->where('des_nm', $request->mem_desig)->value('sl_no');

        $pic=wbApplicant::where('mem_id', $request->mem_id)->select('mem_id','profile_pic')->first();

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
            
            elseif($request->file('profile_pic') == "")
            {
                $filename = $pic->profile_pic;
            }

            $pic->profile_pic=$filename;
            $pic->save();

        $editmem=wbApplicant::where('mem_id', $request->mem_id)
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
        return redirect()->route('ad.adminMeMQue')->with('msg','Member has been updated  successfully');
    }

    public function adminExpoMember()
    {
        
        $mem_id = request('mem_id');
        $memo_no = request('memo_no');
        $mem_nm = request('mem_nm');
        $mem_posting_place = request('mem_posting_place');
        $mem_desig = request('mem_desig');
        $media_nm = request('media_nm');

        // $des_type = request('des_type');
      
        $query =  wbApplicant::where('mem_stat','A')->where('reg_status','!=','new')
        ->select('mem_id','memo_no','profile_pic','mem_desig','birth_dt','mem_posting_place','mem_nm','media_nm','guard_nm','mem_quali','export_stat');
        // dd( $query);
      
        $all_memid = '';
  
            if($mem_id != '')
            {
            $query = $query->where('mem_id', 'like', '%' . $mem_id . '%');
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
           
            if($mem_desig != '')
            {
              $query = $query->where('mem_desig', 'like', '%' . $mem_desig . '%');
            }

            if($media_nm != '')
            {
                $query = $query->where('media_nm', 'like', '%' . $media_nm . '%');
            }

            
            $mem_query= $query->paginate(100);
            $mem_query_total= count($mem_query);
            // dd($mem_query_total);
            $mem_query->appends([
                'mem_id' => $mem_id,
                'memo_no' => $memo_no,
                'mem_nm' => $mem_nm,
                'mem_posting_place' =>$mem_posting_place,
                'mem_desig' =>$mem_desig,
                'media_nm' => $media_nm
            ]);

            $media_na = DB::table('fcpm_mast')->where('media_nm','!=','')
            ->select('media_nm')
            ->groupBy('media_nm')
            ->orderBy('media_nm')
            ->get();
    
   
        return view ('admin.membership.adminExpoMember',compact('mem_query','mem_query_total','media_na'));
    }


    public function memExport(Request $request, $id)
    {
        // dd(strlen($id));
        if (strlen($id) == 1) {
            $id_a = '0000'.$id;
        }
        elseif (strlen($id) == 2) {
            $id_a = '000'.$id;
        }
        elseif (strlen($id) == 3) {
            $id_a = '00'.$id;
        }
        elseif (strlen($id) == 4) {
            $id_a = '0'.$id;
        }
        elseif (strlen($id) == 5) {
            $id_a = $id;
        }
        $mem_expo = wbApplicant::where('mem_stat','A')
            ->where('reg_status','!=','new')
            ->where('mem_id', $id_a)
            ->select('mem_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id')
            ->first();
        // dd($mem_expo->mem_id);
        wbApplicant::where('mem_id', $id_a)
            ->update([
                'export_stat' => 'Y'
            ]);
     
     
    //   $mem_expo_entry = webUser::orderBy('mem_id','DESC');
    //   ->first();
    $mem= new webUser;
    $mem->mem_id=$id_a;
    $mem->mem_id_old=$mem_expo->mem_id_old;
    $mem->mem_nm=$mem_expo->mem_nm;
    $mem->mem_add=$mem_expo->mem_add;
    $mem->district=$mem_expo->district;
    $mem->guard_relatiion=$mem_expo->guard_relatiion;
    $mem->guard_nm=$mem_expo->guard_nm;
    $mem->mem_quali=$mem_expo->mem_quali;
    $mem->contact_no=$mem_expo->contact_no;
    $mem->mem_email=$mem_expo->mem_email;
    $mem->birth_dt=$mem_expo->birth_dt;
    $mem->mem_cast=$mem_expo->mem_cast;
    $mem->gender=$mem_expo->gender;
    $mem->media_nm=$mem_expo->media_nm;
    $mem->memo_no=$mem_expo->memo_no;
    $mem->memo_no_old=$mem_expo->memo_no_old;
    $mem->entry_dt=$mem_expo->entry_dt;
    $mem->mem_desig=$mem_expo->mem_desig;
    $mem->mem_posting_place=$mem_expo->mem_posting_place;
    $mem->profile_pic=$mem_expo->profile_pic;
    $mem->mem_stat=$mem_expo->mem_stat;
    $mem->des_type=$mem_expo->des_type;
    $mem->sl_no=$mem_expo->sl_no;
    $mem->mem_posting_place=$mem_expo->mem_posting_place;
    $mem->mem_posting_place=$mem_expo->mem_posting_place;
    $mem->save();

    // dd( $mem_expo_entry);
      return redirect()->route('ad.adminExpoMeM')->with('msg','Member has been exported successfully');
    }

    public function adminConfiLetter()
    {
        $mem_id = request('mem_id');
        $memo_no = request('memo_no');
        $memo_id = request('memo_id');

        $print_stat = DB::table('print_letter_mast')->where('memo_id','!=','')->select('memo_id')->get();
       
// dd( $print_stat);
        $query =  wbApplicant::where('mem_stat','A')->where('export_stat','Y')
        // ->whereNotNull('memo_no')
        ->select('mem_id','memo_no','profile_pic','mem_desig','birth_dt','mem_posting_place','mem_nm','media_nm','guard_nm','mem_quali','memo_id');
        // dd( $query);
      
        $all_memid = '';
  
            if($mem_id != '')
            {
            $query = $query->where('mem_id', 'like', '%' . $mem_id . '%');
            }

            if($memo_no != '')
            {
            $query = $query->where('memo_no', 'like', '%' . $memo_no . '%');
            }
           
            // if($memo_id == 'P')
            // {
            //     $print_stat = $print_stat->where('memo_id','!=', '');
            // }
            // elseif ($memo_id == 'NP') {
            //     $print_stat = $print_stat->where('memo_id', '');
            // }

            $mem_query= $query->paginate(100);
            $mem_query_total= count($mem_query);
            // dd($mem_query_total);
            $mem_query->appends([
                'mem_id' => $mem_id,
                'memo_no' => $memo_no,
                // 'memo_id' => $memo_id
            ]);
   
        return view ('admin.membership.adminConfiLetter',compact('mem_query','mem_query_total','print_stat'));
    }

    public function maPrint($id)
    {
        dd('hfdk');
    //     if (strlen($id) == 1) {
    //         $id_a = '0000'.$id;
    //     }
    //     elseif (strlen($id) == 2) {
    //         $id_a = '000'.$id;
    //     }
    //     elseif (strlen($id) == 3) {
    //         $id_a = '00'.$id;
    //     }
    //     elseif (strlen($id) == 4) {
    //         $id_a = '0'.$id;
    //     }
    //     elseif (strlen($id) == 5) {
    //         $id_a = $id;
    //     }
    //     $ma_print = wbApplicant::where('mem_stat','A')
    //     ->where('reg_status','!=','new')
    //     ->where('mem_id', $id_a)
    //     ->select('mem_id','memo_id')
    //     ->first();
    // dd($ma_print->mem_id);

    // wbApplicant::where('mem_id', $id_a)
    //     ->update([
    //         'memo_id' => 'Y'
    //     ]);
        
    }

    public function adminJoinLetter()
    {
        return view ('admin.membership.adminJoinLetter');
    }

    public function adminRePrintJoiningLetter()
    {
        return view ('admin.membership.adminRePrintJoinLetter');
    }

    public function adminDeclarationLetter()
    {
        return view ('admin.membership.adminDeclarationLetter');
    }

    public function adminRepnDeclarationLetter()
    {
        return view ('admin.membership.adminReprintDeclarationLetter');
    }

    public function adminAppointmentLetter()
    {
        return view ('admin.membership.adminAppointmentLetter');
    }

    public function adminRepnAppointmentLetter()
    {
        return view ('admin.membership.adminReprintAppointmentLetter');
    }

}