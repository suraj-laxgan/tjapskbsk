<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\wbApplicant;
use App\Models\Admin\webUser;
use App\Models\Admin\printConLetter;
use App\Models\Admin\Designation;
use DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\allMemberExport;
use App\Exports\allMemberQueryExport;
use App\Exports\confirmationLetter;
use App\Exports\joiningLetter;

use Illuminate\Support\Collection;
use Auth;
use Illuminate\Support\Str;

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
            ->select('state_nm','state_code','state_id')
            ->orderBy('state_id','ASC')
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
            'guard_nm' => 'required',
            'birth_dt' => 'required',
            'mem_add' => 'required',
            'mem_aadhar_no' => 'required | integer',
            'mem_pan_no' =>  'required',
            'mem_voterid_no'=> 'required',
            'bank_acount_no'=> 'required | integer',
            'mem_bank_nm' => 'required',
            'bnk_ifsc_code' => 'required',
            'des_type' => 'required',
            'mem_desig' => 'required',
            'profile_pic' => 'image|mimes:jpg,png|max:2048'
        ],
        [
            'state_nm.required' => 'State Name is required ',
            'mem_nm.required' => 'Member Name is required ',
            'media_nm.required' => 'Media Name is requirfd',
            'entry_dt.required' => 'Entry Date is required',
            'contact_no.required' => 'Contact No is required',
            'mem_email.required' => 'Email is required',
            'guard_nm.required' => 'Guardian name is required',
            'birth_dt.required' => 'Birth Date is required',
            'mem_add.required' => 'Address is required',
            'mem_aadhar_no.required' => 'Aadhar No is required',
            'mem_pan_no.required' => 'Pan No is required',
            'mem_voterid_no.required' => 'Votyer id No is required',
            'bank_acount_no.required' => 'Bank Account No is required',
            'mem_bank_nm.required' => 'Bank Name is required',
            'bnk_ifsc_code.required' => 'Bank ifsc code is required',
            'des_type.required' => 'Designation Type is required',
            'mem_desig.required' => 'Designation is required',
            'profile_pic.required' => 'Profile picture is required',




      ]);
    
    //   $max_memo_no = DB::table('memo_no_max')->get();
    //   dd( $max_memo_no);

    $state_id =$request->state_id;
    // dd($state_id);
    
        $check_post = DB::table('desig_mast')->where('des_type', $request->des_type)->where('des_nm', $request->mem_desig)->where('state_id', $request->state_id)->value('des_no_post');
        
        $check_fcpm = $this->check_fcpm($request);
        // dd($check_fcpm);
        // dd($check_post,$check_fcpm);
        if($check_post > $check_fcpm){
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
           
            // $state_code =$request->state_nm;

            // $max_new_id = wbApplicant::orderBy('new_id','DESC')->orWhere('new_id', 'like', '%' . $state_code . '%')->value('new_id');

            // $state_nm = DB::table('state_mast')->where('state_code', $state_code)
            //     ->value('state_nm');

            $state_id =$request->state_id;
            $state_dtl = DB::table('state_mast')->where('state_id', $state_id)->select('state_nm','state_code','state_id')->first();
            $state_nm = $state_dtl->state_nm; 
            $state_code = $state_dtl->state_code; 

            $max_new_id = wbApplicant::orderBy('new_id','DESC')->orWhere('new_id', 'like', '%' . $state_code . '%')->value('new_id');
        
            // dd( $state_id, $state_nm,$state_code);
            
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
            // $filename = $mem_id. '.' . $upload->getClientOriginalExtension();
            // $upload->move(public_path('mem_regis_upload'), $filename);
            $upload->move(public_path('photo'), $filename);

            //head office,distric ofice,
            if($request->des_type=='HEAD OFFICE')
            {
                $mem_posting_place='HEAD OFFICE';
            }
            elseif($request->des_type=='DISTRICT OFFICE')
            {
                $mem_posting_place=$request->district.' DISTRICT OFFICE';
            }
            elseif($request->des_type=='BLOCK OFFICE')
            {
                $mem_posting_place=$request->mem_posting_place;
            }
            else
            {
                $mem_posting_place='';
            }
           
            $mem= new wbApplicant;
            $mem->mem_id=$mem_id;
            $mem->memo_no=$memo_no;
            $mem->new_id=$new_id;
            $mem->state_id=$state_id;
            $mem->state_nm=$state_nm;
            $mem->state_code=$state_code;
            $mem->mem_nm=Str::upper($request->mem_nm);
            $mem->media_nm=Str::upper($request->media_nm);
            $mem->entry_dt=$request->entry_dt;
            $mem->contact_no=$request->contact_no;
            $mem->mem_email=$request->mem_email;
            $mem->guard_relatiion=$request->guard_relatiion;
            $mem->guard_nm=Str::upper($request->guard_nm);
            $mem->gender=$request->gender;
            $mem->mem_cast=Str::upper($request->mem_cast);
            $mem->birth_dt=$request->birth_dt;
            $mem->mem_quali=Str::upper($request->mem_quali);
            $mem->mem_add=Str::upper($request->mem_add);
            $mem->mem_aadhar_no=$request->mem_aadhar_no;
            $mem->mem_pan_no=Str::upper($request->mem_pan_no);
            $mem->mem_voterid_no=Str::upper($request->mem_voterid_no);
            $mem->bank_acount_no=$request->bank_acount_no;
            $mem->mem_bank_nm=Str::upper($request->mem_bank_nm);
            $mem->bnk_ifsc_code=Str::upper($request->bnk_ifsc_code);
            $mem->des_type=$request->des_type;
            $mem->mem_desig=$request->mem_desig;
            $mem->district=$request->district_nm;
            $mem->mem_posting_place=$mem_posting_place;
            $mem->sl_no=$sl_nos;
            $mem->profile_pic=$filename;
            $mem->save();
            return redirect()->route('ad.adminmember')->with('msg','Member has been resgistered successfully');
        }
        else{
            return redirect()->route('ad.adminmember')->with('msg','Maximum Designation Limit Reach');
        }
        
    }
    private function check_fcpm($request){
        $check_fcpm = wbApplicant::where('des_type', $request->des_type)->where('mem_desig', $request->mem_desig)
        ->where('state_id', $request->state_id);
        if($request->district != ''){
            $check_fcpm = $check_fcpm->where('district', $request->district);
        }
        if($request->mem_posting_place != ''){
            $check_fcpm = $check_fcpm->where('mem_posting_place', $request->mem_posting_place);
        }
        if($request->state_id != ''){
            $check_fcpm = $check_fcpm->where('state_id', $request->state_id);
        }
        $check_fcpm = $check_fcpm->count();
        return $check_fcpm;
    }

    public function findDesignationName(Request $r)
    {
        if($r->ajax())
        {
            $des_type = $r->des_type;
            $state_id =  $r->state_id;
            // dd(  $state_id );
            $find_des_type = Designation::where('des_type',$des_type)->where('state_id',$state_id)
                // ->where('state_id',$des_type)
                ->orderBy('des_nm')
                ->get();
                // dd($find_des_type);
            return $find_des_type;
        }
    }

    // public function findDisName(Request $r)
    // {
    //     if($r->ajax())
    //     {
    //         $mem_dist = $r->mem_dist;
    //         $place_of_post = DB::table('block_mast')->where('district_nm',$mem_dist)
    //             ->orderBy('block_nm')
    //             ->get();
    //         return $place_of_post;
    //     }
    // }

    public function dkName(Request $r)
    {
        if($r->ajax())
        {
            
            $state_id =  $r->state_id;
            // dd( $state_id);
            $district_nm = DB::table('district_mast')->where('state_id',$state_id)
                ->orderBy('district_nm')->get();
                // dd( $district_nm); 
            return $district_nm;
        }
    }

    public function blockName(Request $r)
    {
        if($r->ajax())
        {
            $state_id =  $r->state_id;
            $district_nm = $r->district_nm;
            // dd($district_nm,  $state_id );
            $block_nm = DB::table('block_mast')->where('state_id',$state_id)
                ->where('district_nm',$district_nm)
                ->orderBy('block_nm')
                ->get();
            return $block_nm;
        } 
    }
    
    public function findStateName(Request $r)
    {
        if($r->ajax())
        {
            $state_nm = $r->state;
            // dd( $state_nm);
            $state = DB::table('state_mast')->where('state_id',$state_nm)
                ->orderBy('state_nm')
                ->get();
            // dd($state);
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
        
        // $query  = wbApplicant::where('mem_stat','A')->where('reg_status','!=','new')
        //     ->whereNotNull('memo_no')
        //     ->select('mem_id','memo_no','mem_nm','guard_nm','mem_quali','birth_dt','media_nm','mem_desig','mem_posting_place');

        $query  = wbApplicant::where('mem_stat','A')
            ->where(function ($query) {
                $query->where('reg_status','!=','new')
                      ->orWhere('reg_status','')
                      ->orWhereNull('reg_status');
            })
            ->whereNotNull('memo_no')
            ->select('mem_id','memo_no','mem_nm','guard_nm','mem_quali','birth_dt','media_nm','mem_desig','mem_posting_place');
  
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
           
            $mem_dist = DB::table('district_mast')->orderBy('state_id')->get();

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
        
        // dd($id);
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
        // $id = request('mem_id');
        $mem_view = DB::table('fcpm_mast')->where('mem_id', $id_a)
            ->select('mem_id','mem_nm','guard_nm','profile_pic','mem_posting_place','mem_desig','entry_dt','memo_no','state_nm')
            ->first();
        // dd( $mem_view);
        return view('admin.membership.adminExisMemSmallView',compact('mem_view'));
    }
    
    public function memEdit($id)
    {
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

        // $id = request('mem_id');
        $mem_dist = DB::table('district_mast')
        ->orderBy('state_id')
        ->get();

        $state_name = DB::table('state_mast')
        // ->where('state_code','!=','')
            ->select('state_nm','state_code','state_id')
            ->orderBy('state_nm','DESC')
            ->get();

        // dd( $mem_dist);
        $mem_edit = DB::table('fcpm_mast')->where('mem_id', $id_a)
            ->select('state_code','state_id','state_nm','mem_nm','media_nm','entry_dt','contact_no','mem_email','guard_nm','gender','mem_cast','birth_dt','mem_quali','guard_relatiion','mem_add','mem_aadhar_no','mem_pan_no','mem_voterid_no','bank_acount_no','mem_bank_nm','bnk_ifsc_code','des_type','profile_pic','mem_posting_place','mem_desig','memo_no','mem_id','district')
            ->first();
            // $mem_id=request('mem_id');
            // dd( $mem_id);
        // dd( $mem_edit);
        $district_nm = DB::table('district_mast')->where('state_id',$mem_edit->state_id)
                ->orderBy('district_nm')->get();
        return view('admin.membership.adminExisMemEdit',compact('mem_edit','mem_dist','state_name','district_nm'));
    }

    public function adminMemUpload(Request $request)
    {
        $mem_id = $request->mem_id;
        // dd($mem_id);

    //     $validated = $request->validate([
    //         'mem_nm' => 'required',
    //         'media_nm' => 'required',
    //         'entry_dt' => 'required',
    //         'contact_no' => 'required | integer',
    //         'mem_email' => 'required|string|email|max:255|unique:fcpm_mast',
    //     ],
    //     [
    //         'mem_nm.required' => 'Member Name is required ',
    //         'media_nm.required' => 'Media Name is requirfd',
    //         'entry_dt.required' => 'Entry Date is required',
    //         'contact_no.required' => 'Contact No is required',
    //         'mem_email.required' => 'Email is required'
    //   ]);

    //   $check_post = DB::table('desig_mast')->where('des_type', $request->des_type)->where('des_nm', $request->mem_desig)->value('des_no_post');

    //   $check_fcpm = $this->check_fcpm($request);
      
    //   // dd($check_post,$check_fcpm);
    //   if($check_post > $check_fcpm){

        $sl_nos = DB::table('desig_mast')->where('des_type', $request->des_type)->where('des_nm', $request->mem_desig)->value('sl_no');

        $pic=wbApplicant::where('mem_id', $request->mem_id)->select('mem_id','profile_pic')->first();

            if($request->file('profile_pic') != "" && $pic->profile_pic != "")
            {
            unlink(public_path('mem_regis_upload/'.$pic->profile_pic));
            $upload = $request->file('profile_pic');
            $filename =$mem_id.'.'. rand(1,99999). '.' . $upload->guessExtension();
            // $upload->move(public_path('mem_regis_upload'), $filename);
            $upload->move(public_path('photo'), $filename);

            }
            elseif($request->file('profile_pic') != "")
            {
                $upload = $request->file('profile_pic');
                $filename =$mem_id.'.'. rand(1,99999). '.' . $upload->guessExtension();
                // $upload->move(public_path('mem_regis_upload'), $filename);
                $upload->move(public_path('photo'), $filename);

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
            'mem_nm' =>Str::upper($request->mem_nm),
            'media_nm' => Str::upper($request->media_nm),
            'entry_dt' => $request->entry_dt,
            'contact_no' => $request->contact_no,
            'mem_email' => $request->mem_email,
            'guard_relatiion' => $request->guard_relatiion,
            'guard_nm' =>Str::upper($request->guard_nm),
            'gender' => $request->gender,
            'mem_cast' => Str::upper($request->mem_cast),
            'birth_dt' => $request->birth_dt,
            'mem_quali' => Str::upper($request->mem_quali),
            'mem_add' => Str::upper($request->mem_add),
            'mem_aadhar_no' => $request->mem_aadhar_no,
            'mem_pan_no' => Str::upper($request->mem_pan_no),
            'mem_voterid_no' => Str::upper($request->mem_voterid_no),
            'bank_acount_no' => $request->bank_acount_no,
            'mem_bank_nm' =>  Str::upper($request->mem_bank_nm),
            'bnk_ifsc_code' => Str::upper($request->bnk_ifsc_code),
            'des_type' => $request->des_type,
            'mem_desig' => $request->mem_desig,
            'district' => $request->district,
            'mem_posting_place' => $request->mem_posting_place,
            'sl_no'=> $sl_nos
            // 'profile_pic' => $request->profile_pic
        ]);
    //    dd( $editmem);
        return redirect()->route('ad.adminexmember')->with('msg','Member has been updated  successfully');
        // }
        // else{
        //     return redirect()->route('ad.adminexmember')->with('msg','MemberExists');
        // }
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
       
        // $mem_id = request('mem_id');
        $mem_stat = request('mem_stat');
        $memo_no = request('memo_no');
    //    dd($mem_id);

        // $query =  wbApplicant::where('mem_stat','A')->where('reg_status','!=','new')
        // ->select('mem_id','memo_no','profile_pic','mem_desig','birth_dt','mem_posting_place','mem_nm','media_nm');
        // dd( $query);

        $query  = wbApplicant::where('mem_stat','A')
        ->where(function ($query) {
            $query->where('reg_status','!=','new')
                  ->orWhere('reg_status','')
                  ->orWhereNull('reg_status');
        })
        ->whereNotNull('memo_no')
        ->select('mem_id','memo_no','mem_nm','guard_nm','mem_quali','birth_dt','media_nm','mem_desig','mem_posting_place','profile_pic','memo_id');
      
  
            // if($mem_id != '')
            // {
            // $query = $query->where('mem_id', 'like', '%' . $mem_id . '%');
            // }

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
                // 'mem_id' => $mem_id,
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

        // $id = request('mem_id');
        $mem_details = DB::table('fcpm_mast')->where('mem_id', $id_a )
            ->select('mem_id','mem_nm','guard_nm','profile_pic','mem_posting_place','mem_desig','entry_dt','memo_no','state_nm')
            ->first();
        // dd( $mem_details);
        return view('admin.membership.adminMemberQuerySmallView',compact('mem_details'));
    }

    public function memQueryEdit($id)
    {
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

        // $id = request('mem_id');
        // $mem_dist = DB::table('district_mast')
        // ->orderBy('district_nm')
        // ->get();

        $state_name = DB::table('state_mast')
        // ->where('state_code','!=','')
            ->select('state_nm','state_code')
            ->orderBy('state_nm','DESC')
            ->get();

        // dd( $mem_dist);
        $mem_edit = DB::table('fcpm_mast')->where('mem_id', $id_a )
            ->select('state_code','state_nm','state_id','mem_nm','media_nm','entry_dt','contact_no','mem_email','guard_nm','gender','mem_cast','birth_dt','mem_quali','guard_relatiion','mem_add','mem_aadhar_no','mem_pan_no','mem_voterid_no','bank_acount_no','mem_bank_nm','bnk_ifsc_code','des_type','profile_pic','mem_posting_place','mem_desig','memo_no','mem_id','district')
            ->first();
            // $mem_id=request('mem_id');
            // dd( $mem_id);
        // dd( $mem_edit);

        $district_nm = DB::table('district_mast')->where('state_id',$mem_edit->state_id)
        ->orderBy('district_nm')->get();

        return view('admin.membership.adminMemberQueryEdit',compact('mem_edit','state_name','district_nm'));
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
            'mem_nm' => Str::upper($request->mem_nm),
            'media_nm' =>Str::upper($request->media_nm),
            'entry_dt' => $request->entry_dt,
            'contact_no' => $request->contact_no,
            'mem_email' => $request->mem_email,
            'guard_relatiion' => $request->guard_relatiion,
            'guard_nm' => Str::upper($request->guard_nm),
            'gender' => $request->gender,
            'mem_cast' => Str::upper($request->mem_cast),
            'birth_dt' => $request->birth_dt,
            'mem_quali' => Str::upper($request->mem_quali),
            'mem_add' =>Str::upper($request->mem_add),
            'mem_aadhar_no' => $request->mem_aadhar_no,
            'mem_pan_no' => Str::upper($request->mem_pan_no),
            'mem_voterid_no' => Str::upper($request->mem_voterid_no),
            'bank_acount_no' => $request->bank_acount_no,
            'mem_bank_nm' => Str::upper($request->mem_bank_nm),
            'bnk_ifsc_code' =>Str::upper($request->bnk_ifsc_code),
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

        $query  = wbApplicant::where('mem_stat','A')
        ->where(function ($query) {
            $query->where('reg_status','!=','new')
                  ->orWhere('reg_status','')
                  ->orWhereNull('reg_status');
        })
        ->whereNotNull('memo_no')
        ->select('mem_id','memo_no','profile_pic','mem_desig','birth_dt','mem_posting_place','mem_nm','media_nm','guard_nm','mem_quali','export_stat');

        // $query =  wbApplicant::where('mem_stat','A')->where('reg_status','!=','new')
        // ->select('mem_id','memo_no','profile_pic','mem_desig','birth_dt','mem_posting_place','mem_nm','media_nm','guard_nm','mem_quali','export_stat');
        // dd( $query);
      
        // $all_memid = '';
  
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
        // dd($id);
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
        // $mem_expo = wbApplicant::where('mem_stat','A')
        //     ->where('reg_status','!=','new')
        //     ->where('mem_id', $id_a)

            $mem_expo  = wbApplicant::where('mem_stat','A')->where('mem_id', $id_a)
            ->where(function ($query) {
                $query->where('reg_status','!=','new')
                      ->orWhere('reg_status','')
                      ->orWhereNull('reg_status');
            })
            ->whereNotNull('memo_no')
            ->select('mem_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id','state_id',)
            ->first();
        // dd($mem_expo->mem_posting_place);
        wbApplicant::where('mem_id', $id_a)
            ->update([
                'export_stat' => 'Y'
            ]);
     
        //   $mem_expo_entry = webUser::orderBy('mem_id','DESC');
        //   ->first();
        $mem= new webUser;
        $mem->mem_id=$id_a;
        $mem->new_id=$mem_expo->new_id;
        $mem->state_id=$mem_expo->state_id;
        $mem->state_code=$mem_expo->state_code;
        $mem->state_nm=$mem_expo->state_nm;
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
        $mem->save();

        return redirect()->route('ad.adminExpoMeM')->with('msg','Member has been exported successfully');
    }

    public function adminConfiLetter()
    {
        $memo_id = request('memo_id');
        $memo_no = request('memo_no');
        $memo_stat = request('memo_stat');
        // dd(  $memo_id);
        $print_stat = DB::table('print_letter_mast')->where('memo_id','!=','')->select('memo_id')->first();
       
        // dd( $memo_id);
        $query =  wbApplicant::where('mem_stat','A')->where('export_stat','Y')
        // ->whereNotNull('memo_no')
        ->select('mem_id','memo_no','profile_pic','mem_desig','birth_dt','mem_posting_place','mem_nm','media_nm','guard_nm','mem_quali','memo_id','joi_memo_id');
        // dd( $query);


            if($memo_no != '')
            {
            $query = $query->where('memo_no', 'like', '%' . $memo_no . '%');
            }
            
            if($memo_id != '')
            {
            $query = $query->where('memo_id', 'like', '%' . $memo_id . '%');
            }
           
            if($memo_stat == 'P')
            {
                $query = $query->where('memo_id', '!=', '');
            }
            elseif ($memo_stat == 'NP') {
                $query = $query->where('memo_id', '');
            }

            $mem_query= $query->paginate(100);
            $mem_query_total= count($mem_query);
            // dd($mem_query[0]);
            $mem_query->appends([
                'memo_stat' => $memo_stat,
                'memo_no' => $memo_no,
                'memo_id' => $memo_id
            ]);
   
        return view ('admin.membership.adminConfiLetter',compact('mem_query','mem_query_total','print_stat'));
    }

    public function maPrint(Request $request, $id)
    {
        // dd($id);
       
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
        
        // $ma_print = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // // ->where('mem_id', $id)
        // ->where('mem_id', $id_a)

        $ma_print  = wbApplicant::where('mem_stat','A')->where('mem_id', $id_a)
            ->where(function ($query) {
                $query->where('reg_status','!=','new')
                      ->orWhere('reg_status','')
                      ->orWhereNull('reg_status');
            })
            ->whereNotNull('memo_no')
            ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id')
            ->first();
        // dd($ma_print->state_code);

       
        $max_memo_id = wbApplicant::orderBy('memo_id','desc')->value('memo_id');
            if($max_memo_id =="")
            {
                $memo_id = "TJAPSKBSK/00001/".date('Y');
            }
            else{
                $me_no = substr($max_memo_id,9,6);
                $last_memo_id = ++$me_no;
                $last = str_pad($last_memo_id,6,"0",STR_PAD_LEFT);
                $memo_id = 'TJAPSKBSK'.$last.'/'.date('Y');
            }
           
    // dd($memo_id );
    
            wbApplicant::where('mem_id', $id_a)
            ->update([
                'rand_no' => rand(),
                'memo_id' => $memo_id
            ]);
           
        
        return view('admin.membership.adminConfiLetterPrint',compact('ma_print'));
    }

    public function maRePrint($id)
    {
        $memo_id =request('memo_id');
        $print_dt = request('print_dt');
        // dd( $memo_id);

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
        // $ma_print = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // ->where('mem_id', $id_a)

        $ma_print  = wbApplicant::where('mem_stat','A')->where('mem_id', $id_a)
            ->where(function ($query) {
                $query->where('reg_status','!=','new')
                      ->orWhere('reg_status','')
                      ->orWhereNull('reg_status');
            })
            ->whereNotNull('memo_no')
            ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id','rand_no')
            ->first();

        $print_letter_dtl = DB::table('print_letter_mast')->where('memo_id',$ma_print->memo_id)
        ->value('print_dt');
        // dd($ma_print, $print_letter_dtl);
        // dd($print_letter_dtl);
        // dd($ma_print->memo_no);
        // return view('admin.membership.adminConfiLetterPrint',compact('ma_print'));
        return view('admin.membership.adminConLetPriCom',compact('ma_print','print_letter_dtl'));

        
    }

    public function printLetter(Request $request, $id)
    {
        $memo_id =request('memo_id');
        $print_dt = request('print_dt');
        // dd( $print_dt);

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

        $user_nam = Auth::guard('admin')->user()->admin_user_id;
        // dd($user_nam);

        $ipAddress = $request->ip();
        // dd($ipAddress);
        // $table->macAddress('device');
        // $table->ipAddress('visitor');
        // dd( $ipAddress);

        // $ma_print = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // ->where('mem_id', $id_a)

        $ma_print  = wbApplicant::where('mem_stat','A')->where('mem_id', $id_a)
            ->where(function ($query) {
                $query->where('reg_status','!=','new')
                      ->orWhere('reg_status','')
                      ->orWhereNull('reg_status');
            })
            ->whereNotNull('memo_no')
        ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id',)
        ->first();
        $max_print_id = DB::table('print_letter_mast')->orderBy('print_id','desc')->value('print_id');
        // dd( $print);
        if($max_print_id =="")
        {
            $print_id = "PRT0000000001";
        }
        else{
            $lastp = substr($max_print_id,3,10);
            $last_print_id = ++$lastp;
            $last = str_pad($last_print_id,10,"0",STR_PAD_LEFT);
            $print_id = 'PRT'.$last;
        }
// dd($print_id);
       
        $print = new printConLetter;
       
        $print->print_id = $print_id;
        $print -> memo_id = $ma_print->memo_id;
        $print ->user_id = $user_nam;
        $print ->ip_add = $ipAddress;
        $print->print_dt = $print_dt;
        // $print->print_dt = date('d-m-Y');
        $print->print_time = date('H:i:s');
        // dd($print);
        $success =   $print -> save();
        
       $print_letter_dtl = DB::table('print_letter_mast')->where('memo_id',$ma_print->memo_id)
        ->value('print_dt');
        // dd($print_letter_dtl);
        // $ma_print->appends([
        //         // 'mem_id' => $mem_id,
        //         'memo_id' => $memo_id,
        //         'print_dt' => $print_dt
        //     ]);
        // dd($print_letter_dtl );
          
        return view('admin.membership.adminConLetPriCom',compact('ma_print','print_letter_dtl'));

    }
    public function printAddress($id)
    {
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

        $ma_print = wbApplicant::where('mem_stat','A')
        ->where('reg_status','!=','new')
        ->where('mem_id', $id_a)
        ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id','rand_no')
        ->get();
        return view('admin.membership.adminConLettAddress',compact('ma_print'));
    }

    public function conLetExcel()
    {
        return Excel::download(new confirmationLetter, 'confirmataon.xlsx');
    }


    public function adminJoinLetter()
    {
        // $mem_id = request('mem_id');
        $memo_no = request('memo_no');
        $mem_nm = request('mem_nm');
        
        $query = wbApplicant::where('mem_stat','A');
        if($memo_no != '')
        {
        $query = $query->where('memo_no', 'like', '%' . $memo_no . '%');
        }
        
        if($mem_nm != '')
        {
            // dd($mem_nm);
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
        }
        
        $query  = wbApplicant::where('memo_id','!=','')
            ->where(function ($query) {
                $query->where('reg_status','!=','new')
                    ->orWhere('reg_status','')
                    ->orWhereNull('reg_status');
            })
            ->whereNotNull('memo_no');

        // $query = $query->where('reg_status','!=','new')->where('memo_id','!=','');
        // // ->whereNull('joi_memo_id')
        // $query = $query->orWhere('joi_memo_id','') ->whereNull('joi_memo_id');

        $query = $query->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id','rand_no','joi_memo_id');

        $join_lt=  $query->paginate(100);
        $join_lt_total= count($join_lt);

        // dd($join_lt );
        // $join_lt->appends([
        //     // 'mem_id' => $mem_id,
        //     'memo_no' => $memo_no,
        //     'mem_nm' => $mem_nm
        // ]);
      
        
        return view ('admin.membership.adminJoinLetter',compact('join_lt','join_lt_total',));
    }

    public function joinPrint(Request $request, $id)
    {
    //    dd($id);

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

        // $join_print = wbApplicant::where('mem_stat','A')
        //     ->where('reg_status','!=','new')
        //     // ->where('mem_id', $id) 
        //     ->where('mem_id', $id_a) 
        //     ->orWhere('joi_memo_id','') ->whereNull('joi_memo_id')

            $join_print  = wbApplicant::where('mem_stat','A')->where('mem_id', $id_a)
            ->where(function ($query) {
                $query->where('reg_status','!=','new')
                      ->orWhere('reg_status','')
                      ->orWhereNull('reg_status');
            })
            ->whereNull('joi_memo_id')->orWhere('joi_memo_id','')

            ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id','joi_memo_id')
            ->first();
        // dd($join_print);

        $print = DB::table('print_letter_mast')
        // ->where('print_id','$pid')
       ->where('print_id','!=', '')
    //    ->where('memo_id','memo_id')
       ->first();

    //    dd($print);
   // dd( $print[0]->print_id);
       
        $max_join_memo_id = wbApplicant::orderBy('joi_memo_id','desc')->value('joi_memo_id');
            if($max_join_memo_id =="")
            {
                $joi_memo_id = "TJAPSKBSKJ/00001/".date('Y');
            }
            else{
                $me_no = substr($max_join_memo_id,10,6);
                $last_memo_id = ++$me_no;
                $last = str_pad($last_memo_id,6,"0",STR_PAD_LEFT);
                $joi_memo_id = 'TJAPSKBSKJ'.$last.'/'.date('Y');
            }
           
    // dd($joi_memo_id );
    
            // wbApplicant::where('mem_id', $id_a)
            wbApplicant::where('mem_id', $id_a)
            ->update([
                'joi_rand_no' => rand(),
                'joi_memo_id' => $joi_memo_id
            ]);
        return view('admin.membership.adminJoinLetterPrint',compact('join_print'));
    }

    public function joinPrintCom( $id)
    {
       
        $memo_id = request('memo_id');
        $print_dt = request('print_dt');
        // dd($memo_id);

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

        // $join_print = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // // ->where('mem_id', $id) 
        // ->where('mem_id', $id_a) 
        // ->orWhere('joi_memo_id','') ->whereNull('joi_memo_id')

        $join_print  = wbApplicant::where('mem_stat','A')->where('mem_id', $id_a)
        ->where(function ($query) {
            $query->where('reg_status','!=','new')
                  ->orWhere('reg_status','')
                  ->orWhereNull('reg_status');
        })
        // ->whereNull('joi_memo_id')->orWhere('joi_memo_id','')

        ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id','joi_memo_id','joi_rand_no')
        ->first();
//  dd($join_print );
        DB::table('print_letter_mast')->where('memo_id',$memo_id)
        ->update([
            'joining_letter_stat' => 'T',
            'joining_letter_memo_id' => $join_print->joi_memo_id,
            'joining_letter_dt' => $print_dt
        ]);

        $print_letter_dtl = DB::table('print_letter_mast')->where('memo_id',$memo_id)
        ->value('joining_letter_dt');
        // dd($print_letter_dtl);

        return view('admin.membership.adminJoinLetterPrintCom',compact('join_print','print_letter_dtl'));

    }
   

    public function adminRePrintJoiningLetter()
    {
        $memo_no = request('memo_no');
        $mem_nm = request('mem_nm');
        $joi_memo_id = request('joi_memo_id');

        // dd($joi_memo_id);

        
        // $query = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // ->where('joi_memo_id','!=','')

        $query  = wbApplicant::where('mem_stat','A')->where('joi_memo_id','!=','')
        ->where(function ($query) {
            $query->where('reg_status','!=','new')
                  ->orWhere('reg_status','')
                  ->orWhereNull('reg_status');
        })
        ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id','rand_no','joi_memo_id','joi_rand_no',);
        if($memo_no != '')
        {
        $query = $query->where('memo_no', 'like', '%' . $memo_no . '%');
        }
        
        if($mem_nm != '')
        {
            // dd($mem_nm);
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
        }
       if($joi_memo_id != '')
       {
        $query = $query->where('joi_memo_id', 'like', '%' . $joi_memo_id . '%');
  
       }
        $re_print_join=  $query->paginate(100);
        $re_join_lt_total= count($re_print_join);

       
        // dd($re_join_lt_total );
        return view ('admin.membership.adminRePrintJoinLetter',compact('re_print_join','re_join_lt_total'));
    }
    public function joinLetExcel()
    {
        return Excel::download(new joiningLetter, 'confirmataon.xlsx');
    }

    public function joinRePrintCom($id)
    {
    //    dd($id);
        // $memo_id = request('memo_id');
        // $print_dt = request('print_dt');
        // dd($memo_id);
        
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

        
        // dd($memo_id);

        // $join_print = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // // ->where('mem_id', $id) 
        // ->where('mem_id', $id_a) 
        // ->orWhere('joi_memo_id','') ->whereNull('joi_memo_id')

        $join_print  = wbApplicant::where('mem_stat','A') 
        ->where(function ($query) {
            $query->where('reg_status','!=','new')
                  ->orWhere('reg_status','')
                  ->orWhereNull('reg_status');
        })
            ->where('mem_id', $id_a) 
            ->orWhere('joi_memo_id','')
        ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id','joi_memo_id','joi_rand_no')
        ->first();
        // dd($join_print);
        $memo_id = $join_print['memo_id'];
        // $memo_id = $join_print->memo_id;
        // dd( $memo_id);
        $print_letter_dtl = DB::table('print_letter_mast')->where('memo_id',$memo_id)->value('joining_letter_dt');
           
            // dd( $memo_id);
        // ->first();
        // ->get();

        return view('admin.membership.adminJoinLetterPrintCom',compact('join_print','print_letter_dtl'));

    }

    public function declarationLetter()
    {
        $memo_no = request('memo_no');
        $mem_nm = request('mem_nm');
        
        // $query = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // ->where('joi_memo_id','!=','')

        $query  = wbApplicant::where('mem_stat','A') 
            ->where('joi_memo_id','!=','') 
            ->where(function ($query) {
                $query->where('reg_status','!=','new')
                    ->orWhere('reg_status','')
                    ->orWhereNull('reg_status');
            })
            ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id','rand_no','joi_memo_id','joi_rand_no','dec_memo_id',);
        if($memo_no != '')
        {
        $query = $query->where('memo_no', 'like', '%' . $memo_no . '%');
        }
        
        if($mem_nm != '')
        {
            // dd($mem_nm);
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
        }
      
        $dec_ltr=  $query->paginate(100);
        $dec_lt_total= count($dec_ltr);
        // dd( $dec_lt_total);
        return view ('admin.membership.adminDeclarationLetter',compact('dec_ltr','dec_lt_total'));
    }

    public function declPrint(Request $request,$id)
    {
         //    dd($id);
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

        // $dec_print = wbApplicant::where('mem_stat','A')
        //     ->where('reg_status','!=','new')
        //     // ->where('mem_id', $id) 
        //     ->where('mem_id', $id_a) 
        //     ->where('joi_memo_id','!=','')
        //     // ->orWhere('joi_memo_id','') ->whereNull('joi_memo_id')

            $dec_print  = wbApplicant::where('mem_stat','A')             
                ->where('mem_id', $id_a) 
                ->where('joi_memo_id','!=','') 
                ->where(function ($query) {
                $query->where('reg_status','!=','new')
                    ->orWhere('reg_status','')
                    ->orWhereNull('reg_status');
                })
            ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','media_nm','memo_no','entry_dt','mem_desig','mem_posting_place','mem_stat','des_type','sl_no','state_code','state_nm','new_id','joi_memo_id','dec_memo_id','dec_rand_no')
            ->first();
        // dd($dec_print);

        $print = DB::table('print_letter_mast')
        // ->where('print_id','$pid')
       ->where('print_id','!=', '')
    //    ->where('memo_id','memo_id')
       ->first();

    //    dd($print);
   // dd( $print[0]->print_id);
       
        $max_dec_memo_id = wbApplicant::orderBy('dec_memo_id','desc')->value('dec_memo_id');
            if($max_dec_memo_id =="")
            {
                $dec_memo_id = "TJAPSKBSKD/00001/".date('Y');
            }
            else{
                $me_no = substr($max_dec_memo_id,10,6);
                $last_memo_id = ++$me_no;
                $last = str_pad($last_memo_id,6,"0",STR_PAD_LEFT);
                $dec_memo_id = 'TJAPSKBSKD'.$last.'/'.date('Y');
            }
            // dd($dec_memo_id );
            wbApplicant::where('mem_id', $id_a)
            ->update([
                'dec_rand_no' => rand(),
                'dec_memo_id' => $dec_memo_id
            ]);

            
            return view('admin.membership.adminDecLetterPrint',compact('dec_print'));
    }

    public function declPrintCom($id)
    {

        $memo_id = request('memo_id');
        $print_dt = request('print_dt');
        // dd($print_dt);

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

        // $dec_print = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // // ->where('mem_id', $id) 
        // ->where('mem_id', $id_a) 
        // // ->where('dec_memo_id','!=','')
        // ->orWhere('joi_memo_id','') ->whereNull('joi_memo_id')

        $dec_print  = wbApplicant::where('mem_stat','A')             
            ->where('mem_id', $id_a) 
            ->where('joi_memo_id','!=','') 
            ->where(function ($query) {
            $query->where('reg_status','!=','new')
                ->orWhere('reg_status','')
                ->orWhereNull('reg_status');
            })
            ->orWhere('joi_memo_id','') 
            ->whereNull('joi_memo_id')
            ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id','joi_memo_id','joi_rand_no','dec_memo_id','dec_rand_no')
        ->first();

        DB::table('print_letter_mast')->where('memo_id',$memo_id)
        ->update([
            'declear_letter_stat' => 'T',
            'dec_memo_id' => $dec_print->dec_memo_id,
            'dec_letter_dt' => $print_dt
        ]);

        $print_letter_dtl = DB::table('print_letter_mast')->where('memo_id',$memo_id)
        ->value('dec_letter_dt');
        // dd($print_letter_dtl);

        return view('admin.membership.adminDecLetterPrintCom',compact('dec_print','print_letter_dtl'));
    }

    public function adminRepnDeclarationLetter()
    {
        $memo_no = request('memo_no');
        $mem_nm = request('mem_nm');

        // $query = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // // ->where('mem_id', $id_a) 
        // ->where('dec_memo_id','!=','')
        // // ->orWhere('joi_memo_id','') ->whereNull('joi_memo_id')
        
        $query  = wbApplicant::where('mem_stat','A')             
            ->where('dec_memo_id','!=','') 
            ->where(function ($query) {
            $query->where('reg_status','!=','new')
                ->orWhere('reg_status','')
                ->orWhereNull('reg_status');
            })
        ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id','joi_memo_id','joi_rand_no','dec_memo_id','dec_rand_no');

        if($memo_no != '')
        {
        $query = $query->where('memo_no', 'like', '%' . $memo_no . '%');
        }
        
        if($mem_nm != '')
        {
            // dd($mem_nm);
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
        }

        $dec_re_print=  $query->paginate(100);
        $dec_re_print_total= count($dec_re_print);
        return view ('admin.membership.adminReprintDeclarationLetter',compact('dec_re_print','dec_re_print_total'));
    }

    public function decRePrintCom($id)
    {
        // $memo_id = request('memo_id');
        // $print_dt = request('print_dt');
        // dd($print_dt);

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

        // $dec_print = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // // ->where('mem_id', $id) 
        // ->where('mem_id', $id_a) 
        // // ->where('dec_memo_id','!=','')
        // ->orWhere('joi_memo_id','') ->whereNull('joi_memo_id')

        $dec_print  = wbApplicant::where('mem_stat','A')             
            ->where('dec_memo_id','!=','')
            ->where('mem_id', $id_a) 
            ->where(function ($query) {
            $query->where('reg_status','!=','new')
                ->orWhere('reg_status','')
                ->orWhereNull('reg_status');
            })
        ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id','joi_memo_id','joi_rand_no','dec_memo_id','dec_rand_no')
        ->first();
        $memo_id = $dec_print->memo_id;
        // dd($memo_id);
        $print_letter_dtl = DB::table('print_letter_mast')->where('memo_id',$memo_id)
        ->value('dec_letter_dt');
        // dd($print_letter_dtl);

        return view('admin.membership.adminDecLetterPrintCom',compact('dec_print','print_letter_dtl'));
    }

    public function adminAppointmentLetter()
    {
        $memo_no = request('memo_no');
        $mem_nm = request('mem_nm');
        
        // $query = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // ->where('dec_memo_id','!=','')

        $query  = wbApplicant::where('mem_stat','A')             
        ->where('dec_memo_id','!=','') 
        ->where(function ($query) {
        $query->where('reg_status','!=','new')
            ->orWhere('reg_status','')
            ->orWhereNull('reg_status');
        })
        ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion',   'guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id','rand_no','joi_memo_id','joi_rand_no','dec_memo_id','app_memo_id','app_rand_no');
        if($memo_no != '')
        {
        $query = $query->where('memo_no', 'like', '%' . $memo_no . '%');
        }
        
        if($mem_nm != '')
        {
            // dd($mem_nm);
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
        }
      
        $app_ltr=  $query->paginate(100);
        $app_lt_total= count($app_ltr);
        // dd( $app_lt_total);
        return view ('admin.membership.adminAppointmentLetter',compact('app_ltr','app_lt_total'));
    }

    public function appltrPrint(Request $request,$id)
    {
        
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

        // $app_print = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // // ->where('mem_id', $id) 
        // ->where('mem_id', $id_a) 
        // ->where('dec_memo_id','!=','')
        // // ->orWhere('joi_memo_id','') ->whereNull('joi_memo_id')
        
        $app_print  = wbApplicant::where('mem_stat','A') 
            ->where('mem_id', $id_a) 
            ->where('dec_memo_id','!=','') 
            ->where(function ($query) {
            $query->where('reg_status','!=','new')
                ->orWhere('reg_status','')
                ->orWhereNull('reg_status');
            })
            ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','media_nm','memo_no','entry_dt','mem_desig','mem_posting_place','mem_stat','des_type','sl_no','state_code','state_nm','new_id','joi_memo_id','dec_memo_id','dec_rand_no','app_memo_id')
        ->first();
    // dd($app_print);

    $print = DB::table('print_letter_mast')
    // ->where('print_id','$pid')
   ->where('print_id','!=', '')
//    ->where('memo_id','memo_id')
   ->first();

//    dd($print);
// dd( $print[0]->print_id);
   
    $max_app_memo_id = wbApplicant::orderBy('app_memo_id','desc')->value('app_memo_id');
        if($max_app_memo_id =="")
        {
            $app_memo_id = "TJAPSKBSKA/00001/".date('Y');
        }
        else{
            $me_no = substr($max_app_memo_id,10,6);
            $last_memo_id = ++$me_no;
            $last = str_pad($last_memo_id,6,"0",STR_PAD_LEFT);
            $app_memo_id = 'TJAPSKBSKA'.$last.'/'.date('Y');
        }
        // dd($app_memo_id );

        wbApplicant::where('mem_id', $id_a)
        ->update([
            'app_rand_no' => rand(),
            'app_memo_id' => $app_memo_id
        ]);

        return view('admin.membership.adminAppLetterPrint',compact('app_print'));  
    }

    public function appPrintCom($id)
    {
        $memo_id = request('memo_id');
        $print_dt = request('print_dt');
        // dd($print_dt);

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

        // $app_print = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // // ->where('mem_id', $id) 
        // ->where('mem_id', $id_a) 
        // ->where('dec_memo_id','!=','')
        // // ->orWhere('joi_memo_id','') ->whereNull('joi_memo_id')

        $app_print  = wbApplicant::where('mem_stat','A') 
            ->where('mem_id', $id_a) 
            ->where('dec_memo_id','!=','') 
            ->where(function ($query) {
            $query->where('reg_status','!=','new')
                ->orWhere('reg_status','')
                ->orWhereNull('reg_status');
            })
        ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','mem_quali','contact_no','mem_email','birth_dt','mem_cast','gender','media_nm','memo_no','memo_no_old','entry_dt','mem_desig','mem_posting_place','profile_pic','mem_stat','des_type','sl_no','state_code','state_nm','new_id','joi_memo_id','joi_rand_no','dec_memo_id','dec_rand_no','app_memo_id','app_rand_no')
        ->first();
        
        DB::table('print_letter_mast')->where('memo_id',$memo_id)
        ->update([
            'app_letter_stat' => 'T',
            'app_memo_id' => $app_print->app_memo_id,
            'app_letter_dt' => $print_dt
        ]);

        $print_letter_dtl = DB::table('print_letter_mast')->where('memo_id',$memo_id)
        ->value('app_letter_dt');
        // dd($print_letter_dtl);

        return view('admin.membership.adminAppLtrPrintCom',compact('app_print','print_letter_dtl'));
    }

    public function adminRepnAppointmentLetter()
    {
        $memo_no = request('memo_no');
        $mem_nm = request('mem_nm');

        // $query = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // // ->where('mem_id', $id_a) 
        // ->where('app_memo_id','!=','')
        // // ->orWhere('joi_memo_id','') ->whereNull('joi_memo_id')

        $query  = wbApplicant::where('mem_stat','A') 
            ->where('app_memo_id','!=','')
            ->where(function ($query) {
            $query->where('reg_status','!=','new')
                ->orWhere('reg_status','')
                ->orWhereNull('reg_status');
            })
            ->select('mem_id','memo_id','mem_id_old','mem_nm','mem_add','district','guard_relatiion','guard_nm','media_nm','memo_no','entry_dt','mem_desig','mem_posting_place','mem_stat','des_type','sl_no','state_code','state_nm','new_id','joi_memo_id','dec_memo_id','dec_rand_no','app_memo_id','state_nm');
        // ->first();
        if($memo_no != '')
        {
        $query = $query->where('memo_no', 'like', '%' . $memo_no . '%');
        }
        
        if($mem_nm != '')
        {
            // dd($mem_nm);
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
        }
      
        $app_ltr=  $query->paginate(100);
        $app_lt_total= count($app_ltr);

        return view ('admin.membership.adminReprintAppointmentLetter',compact('app_ltr','app_lt_total'));
    }

    public function appRePrintCom($id)
    {
        // $memo_id = request('memo_id');
        // $print_dt = request('print_dt');

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

        // $app_print = wbApplicant::where('mem_stat','A')
        // ->where('reg_status','!=','new')
        // // ->where('mem_id', $id) 
        // ->where('mem_id', $id_a) 
        // ->where('dec_memo_id','!=','')
        // // ->orWhere('joi_memo_id','') ->whereNull('joi_memo_id')

        $app_print  = wbApplicant::where('mem_stat','A') 
            ->where('mem_id', $id_a)
            ->where('app_memo_id','!=','')
            ->where(function ($query) {
            $query->where('reg_status','!=','new')
                ->orWhere('reg_status','')
                ->orWhereNull('reg_status');
            })
            ->select('mem_id','memo_id','mem_nm','mem_add','district','guard_nm','media_nm','memo_no','entry_dt','mem_desig','mem_posting_place','mem_stat','des_type','sl_no','state_nm','new_id','joi_memo_id','joi_rand_no','dec_memo_id','dec_rand_no','app_memo_id','app_rand_no','state_nm')
            ->first();
// dd($app_print);
        $memo_id = $app_print->memo_id;
        // dd($memo_id);
        $print_letter_dtl = DB::table('print_letter_mast')->where('memo_id',$memo_id)
        ->value('app_letter_dt');
        // dd($print_letter_dtl);

        return view('admin.membership.adminAppLtrPrintCom',compact('app_print','print_letter_dtl'));
    }
}
