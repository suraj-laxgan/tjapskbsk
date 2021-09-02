<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\wbApplicant;
use DB;
use Illuminate\Support\Str;
use PDF;

class verifyRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function allRegis()
    {
        return view ('admin.verifiedRegister.allRegister');
    }

    public function verifyRegister()
    {
        $mem_nm = request('mem_nm');
        $state_nm = request('state_id');
        // dd($state_nm);
        $query  = wbApplicant::where('mem_stat','A')
            ->where(function ($query) {
                $query->where('reg_status','!=','new')
                      ->orWhere('reg_status','')
                      ->orWhereNull('reg_status');
            })
            ->whereNotNull('memo_no')
            ->select('mem_id','memo_no','mem_nm','guard_nm','mem_quali','birth_dt','media_nm','mem_desig','mem_posting_place','state_nm','state_id','state_code','trans_stat');
            if($mem_nm != '')
            {
              $query = $query->where('mem_nm', $mem_nm );
            }
            if($state_nm != '')
            {
              $query = $query->where('state_id', 'like', '%' . $state_nm . '%');
            }
            $applicant= $query->paginate(100);
            $appli_total= count($applicant);

            $state_name = DB::table('state_mast')
            // ->where('state_code','!=','')
                ->select('state_nm','state_code','state_id')
                ->orderBy('state_id','ASC')
                ->get();
        return view ('admin.verifiedRegister.register',compact('applicant','appli_total','state_name'));
    }
    
    public function verifyMemEdit($id)
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
            ->select('state_code','state_id','state_nm','mem_nm','media_nm','entry_dt','contact_no','mem_email','guard_nm','gender','mem_cast','birth_dt','mem_quali','guard_relatiion','mem_add','mem_aadhar_no','mem_pan_no','mem_voterid_no','bank_acount_no','mem_bank_nm','bnk_ifsc_code','des_type','profile_pic','mem_posting_place','mem_desig','memo_no','mem_id','district','new_id')
            ->first();
            // $mem_id=request('mem_id');
            // dd( $mem_id);
        // dd( $mem_edit);
        $district_nm = DB::table('district_mast')->where('state_id',$mem_edit->state_id)
                ->orderBy('district_nm')->get();
        return view('admin.verifiedRegister.verifyExisMemEdit',compact('mem_edit','mem_dist','state_name','district_nm'));
    }

    public function verifyMemUpload(Request $request)
    {
        $mem_id = $request->mem_id;
        $state_id =$request->state_id;
        // dd($state_id );
        
        $check_post = DB::table('desig_new_mast')->where('des_type', $request->des_type)
            ->where('des_nm', $request->mem_desig)
            ->where('state_id', $request->state_id)
            ->value('des_no_post');
        // dd(  $check_post);
        $check_fcpm_new = $this->check_fcpm_new($request);
        // dd($check_fcpm_new);
        // dd($check_post,$check_fcpm_new);
        if($check_post > $check_fcpm_new){
            $sl_nos = DB::table('desig_new_mast')->where('des_type', $request->des_type)->where('des_nm', $request->mem_desig)->value('sl_no');
            //   dd($sl_nos);
            
            $max_kbsk_id = DB::table('fcpm_mast_new')->orderBy('kbsk_id','desc')->value('kbsk_id');
            if($max_kbsk_id =="")
            {
                $kbsk_id = "NEW0000000001";
            }
            else{
                $me_no = substr($max_kbsk_id,3,10);
                $last_kbsk_id = ++$me_no;
                $last = str_pad($last_kbsk_id,10,"0",STR_PAD_LEFT);
                $kbsk_id = 'NEW'.$last;
            }
            // dd($kbsk_id);
            
            $upload = $request->file('profile_pic');
            // dd($upload);
            $filename =$kbsk_id.'.'. rand(1,99999). '.' . $upload->getClientOriginalExtension();
            $upload->move(public_path('photo_kbsk_new'), $filename);
            
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
            $fcpm = DB::table('fcpm_mast')->where('mem_id',$mem_id)->select('new_id','memo_no','state_id','state_nm','state_code',)->first();
        //    dd( $fcpm->new_id);
            $mem = DB::table('fcpm_mast_new')->insert([
                'ref_mem_id' => $mem_id,
                'new_id'=> $fcpm->new_id,
                'state_id'=> $fcpm->state_id,
                'state_code'=> $fcpm->state_code,
                'state_nm'=> $fcpm->state_nm,
                'kbsk_id'=>$kbsk_id,
                'memo_no_ref' => $fcpm->memo_no,
                'mem_nm' => Str::upper($request->mem_nm),
                'mem_add'=>Str::upper($request->mem_add),
                'district' => $request->district_nm,
                'guard_relatiion'=>$request->guard_relatiion,
                'guard_nm'=>Str::upper($request->guard_nm),
                'mem_quali'=>Str::upper($request->mem_quali),
                'contact_no'=>$request->contact_no,
                'mem_email'=>$request->mem_email,
                'birth_dt'=>$request->birth_dt,
                'mem_cast'=>$request->mem_cast,
                'gender'=>$request->gender,
                'media_nm'=>Str::upper($request->media_nm),
                'entry_dt'=>$request->entry_dt,
                'mem_desig'=>$request->mem_desig,
                'mem_posting_place'=>$mem_posting_place,
                'profile_pic'=>$filename,
                'des_type'=>$request->des_type,
                'sl_no'=>$sl_nos,
                'mem_aadhar_no'=>$request->mem_aadhar_no,
                'mem_pan_no'=>Str::upper($request->mem_pan_no),
                'mem_voterid_no'=>Str::upper($request->mem_voterid_no),
                'bank_acount_no'=>$request->bank_acount_no,
                'mem_bank_nm'=>Str::upper($request->mem_bank_nm),
                'bnk_ifsc_code'=>Str::upper($request->bnk_ifsc_code)

            ]);
            $tr_status = wbApplicant::where('mem_id',$mem_id)
            ->update([
                'trans_stat'=>'C'
            ]);
            return redirect()->route('add.veRegis')->with('msg','Member has been updated successfully');
        }
        else{
            return redirect()->route('add.veRegis')->with('msg','Maximum Designation Limit Reach');
        }
            
    }
        private function check_fcpm_new($request){
            $check_fcpm_new =  DB::table('fcpm_mast_new')->where('des_type', $request->des_type)
                ->where('mem_desig', $request->mem_desig)
                ->where('state_id', $request->state_id);
            if($request->district != ''){
                $check_fcpm_new = $check_fcpm_new->where('district', $request->district);
            }
            if($request->mem_posting_place != ''){
                $check_fcpm_new = $check_fcpm_new->where('mem_posting_place', $request->mem_posting_place);
            }
            if($request->state_id != ''){
                $check_fcpm_new = $check_fcpm_new->where('state_id', $request->state_id);
            }
            $check_fcpm_new = $check_fcpm_new->count();
            return $check_fcpm_new;
        }

        public function addVerifyMember()
    {
        $state_name = DB::table('state_mast')
        // ->where('state_code','!=','')
            ->select('state_nm','state_code','state_id')
            ->orderBy('state_id','ASC')
            ->get();
        //   dd($state_name) ; 
        return view ('admin.verifiedRegister.verifiedRegistrationForm', compact('state_name'));
    }

        public function addVerifyMemberRegis(Request $request)
        {
          
            $validated = $request->validate([
                // 'state_code' => 'required|max:2',
                'state_id' => 'required',
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
                'state_id.required' => 'State Name is required ',
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
        
        $check_post = DB::table('desig_new_mast')->where('des_type', $request->des_type)
            ->where('des_nm', $request->mem_desig)
            ->where('state_id', $request->state_id)
            ->value('des_no_post');
        // dd(  $check_post);
        $check_fcpm_new = $this->check_fcpm_new($request);
        // dd($check_fcpm_new);
        // dd($check_post,$check_fcpm_new);
        if($check_post > $check_fcpm_new){
            $sl_nos = DB::table('desig_new_mast')->where('des_type', $request->des_type)->where('des_nm', $request->mem_desig)->value('sl_no');
            //   dd($sl_nos);
            
            $max_kbsk_id = DB::table('fcpm_mast_new')->orderBy('kbsk_id','desc')->value('kbsk_id');
            if($max_kbsk_id =="")
            {
                $kbsk_id = "NEW0000000001";
            }
            else{
                $me_no = substr($max_kbsk_id,3,10);
                $last_kbsk_id = ++$me_no;
                $last = str_pad($last_kbsk_id,10,"0",STR_PAD_LEFT);
                $kbsk_id = 'NEW'.$last;
            }
            // dd($max_kbsk_id);
            
            $upload = $request->file('profile_pic');
            // dd($upload);
            $filename =$kbsk_id.'.'. rand(1,99999). '.' . $upload->getClientOriginalExtension();
            $upload->move(public_path('photo_kbsk_new'), $filename);
            
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
       
            $state_name = DB::table('state_mast')
                ->where('state_id',$request->state_id)
                ->select('state_nm','state_code','state_id')
                // ->orderBy('state_id','ASC')
                ->first();
                // dd($state_name);

            $mem = DB::table('fcpm_mast_new')->insert([
                // 'ref_mem_id' => $mem_id,
                // 'new_id'=> $state_name->new_id,
                'state_id'=> $state_name->state_id,
                'state_code'=> $state_name->state_code,
                'state_nm'=> $state_name->state_nm,
                'kbsk_id'=>$kbsk_id,
                // 'memo_no_ref' => $state_name->memo_no,
                'mem_nm' => Str::upper($request->mem_nm),
                'mem_add'=>Str::upper($request->mem_add),
                'district' => $request->district_nm,
                'guard_relatiion'=>$request->guard_relatiion,
                'guard_nm'=>Str::upper($request->guard_nm),
                'mem_quali'=>Str::upper($request->mem_quali),
                'contact_no'=>$request->contact_no,
                'mem_email'=>$request->mem_email,
                'birth_dt'=>$request->birth_dt,
                'mem_cast'=>$request->mem_cast,
                'gender'=>$request->gender,
                'media_nm'=>Str::upper($request->media_nm),
                'entry_dt'=>$request->entry_dt,
                'mem_desig'=>$request->mem_desig,
                'mem_posting_place'=>$mem_posting_place,
                'profile_pic'=>$filename,
                'des_type'=>$request->des_type,
                'sl_no'=>$sl_nos,
                'mem_aadhar_no'=>$request->mem_aadhar_no,
                'mem_pan_no'=>Str::upper($request->mem_pan_no),
                'mem_voterid_no'=>Str::upper($request->mem_voterid_no),
                'bank_acount_no'=>$request->bank_acount_no,
                'mem_bank_nm'=>Str::upper($request->mem_bank_nm),
                'bnk_ifsc_code'=>Str::upper($request->bnk_ifsc_code)

            ]);
                return redirect()->route('ad.verifymember')->with('msg','Member has been resgistered successfully');
            }
            else{
                return redirect()->route('ad.verifymember')->with('msg','Maximum Designation Limit Reach');
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
            $find_des_type = DB::table('desig_new_mast')->where('des_type',$des_type)->where('state_id',$state_id)
                // ->where('state_id',$des_type)
                ->orderBy('des_nm')
                ->get();
                // dd($find_des_type);
            return $find_des_type;
        }
    }

    public function exisMember()
    {
        $mem_nm = request('mem_nm');
        $state_nm = request('state_id');
        $district = request('district');
        $mem_posting_place = request('mem_posting_place');
        $des_type = request('des_type');
        $mem_desig = request('mem_desig');
        $guard_nm = request('guard_nm');
        $media_nm = request('media_nm');
        // dd( $mem_posting_place);
        $query  = DB::table('fcpm_mast_new')->where('kbsk_id','!=','')
            ->select('kbsk_id','mem_nm','guard_nm','mem_quali','birth_dt','media_nm','mem_desig','mem_posting_place','state_nm','state_id','state_code','gender','mem_add');
            // ->get();
        
        if($mem_nm != '')
        {
          $query = $query->where('mem_nm', $mem_nm );
        }
        if($state_nm != '')
        {
          $query = $query->where('state_id', 'like', '%' . $state_nm . '%');
        }
        if($district != '')
        {
          $query = $query->where('district', 'like', '%' . $district . '%');
        }
        if($mem_posting_place != '')
        {
          $query = $query->where('mem_posting_place', 'like', '%' . $mem_posting_place . '%');
        }
        if($des_type != '')
        {
          $query = $query->where('des_type', 'like', '%' . $des_type . '%');
        }
        if($mem_desig != '')
        {
          $query = $query->where('mem_desig', 'like', '%' . $mem_desig . '%');
        }
        if($guard_nm != '')
        {
          $query = $query->where('guard_nm', 'like', '%' . $guard_nm . '%');
        }
        if($media_nm != '')
        {
          $query = $query->where('media_nm', 'like', '%' . $media_nm . '%');
        }
        
        $applicant= $query->paginate(30);
        // dd( $applicant );
        $appli_total= count($applicant);

        $state_name = DB::table('state_mast')
        // ->where('state_code','!=','')
            ->select('state_nm','state_code','state_id')
            ->orderBy('state_id','ASC')
            ->get();

        $media_na = DB::table('fcpm_mast_new')->where('media_nm','!=','')
            ->select('media_nm')
            ->groupBy('media_nm')
            ->orderBy('media_nm')
            ->get();

        return view ('admin.verifiedRegister.verifyExistingMember',compact('applicant','appli_total','state_name','media_na'));
    }

    public function verifiedPDF()
    {   $mem_nm = request('mem_nm');
        $state_nm = request('state_id');
        $district = request('district');
        $mem_posting_place = request('mem_posting_place');
        $des_type = request('des_type');
        $mem_desig = request('mem_desig');
        $guard_nm = request('guard_nm');
        $media_nm = request('media_nm');
        // dd( $media_nm);
        // dd($mem_posting_place);
        $query  = DB::table('fcpm_mast_new')->where('kbsk_id','!=','')
            // ->where('state_id', $state_nm)
            // ->where('sl_no','!=','')
            ->orderBy('sl_no','ASC')
            ->select('kbsk_id','mem_nm','guard_nm','mem_quali','birth_dt','media_nm','mem_desig','mem_posting_place','state_nm','state_id','state_code','gender','mem_add','sl_no','mem_bank_nm','bank_acount_no','bnk_ifsc_code','mem_voterid_no','mem_aadhar_no','mem_cast','profile_pic','marital_status','identity_mark','work_exp','organisation_exp');
            // ->get();
        
        if($mem_nm != '')
        {
          $query = $query->where('mem_nm', $mem_nm );
        }
        if($state_nm != '')
        {
          $query = $query->where('state_id', 'like', '%' . $state_nm . '%');
        }
        if($district != '')
        {
          $query = $query->where('district', 'like', '%' . $district . '%');
        }
        if($mem_posting_place != '')
        {
          $query = $query->where('mem_posting_place', 'like', '%' . $mem_posting_place . '%');
        }
        if($des_type != '')
        {
          $query = $query->where('des_type', 'like', '%' . $des_type . '%');
        }
        if($mem_desig != '')
        {
          $query = $query->where('mem_desig', 'like', '%' . $mem_desig . '%');
        }
        if($guard_nm != '')
        {
          $query = $query->where('guard_nm', 'like', '%' . $guard_nm . '%');
        }
        if($media_nm != '')
        {
          $query = $query->where('media_nm', 'like', '%' . $media_nm . '%');
        }
        $query = $query->get();

        if($state_nm!='')
        {
            $state_name = DB::table('state_mast')->where('state_id',$state_nm )->value('state_nm');
        }
        else
        {
            $state_name = '';
        }        
    //   dd($state_name);

       $pdf = PDF::loadView('admin.verifiedRegister.verifiedMemberPdf',compact('query','state_name'))->setPaper('a4', 'landscape');
    //    dd($pdf);  
      //  return $pdf->download('E-Verification.pdf');  
        return $pdf->stream('statemember.pdf');
    }
}
