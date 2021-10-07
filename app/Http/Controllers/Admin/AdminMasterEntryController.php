<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StateUsers\StUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Admin\Designation;
use App\Models\Admin\organiser;
use App\Models\Admin\district;
use App\Models\Admin\block;
use App\Models\Admin\staff;
use DB;
use Illuminate\Support\Str;
use App\Models\Admin\Admin;
use App\Models\Admin\AdminUserPermission;


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
        $des_type = request('des_type');
        $des_nm = request('des_nm');
        $state_nm = request('state_nm');
        // dd( $state_nm);
        $state = DB::table('state_mast')->select('state_nm','state_code','state_id')
            ->get();
            // dd( $state);

        $desig = DB::table('desig_mast')
        ->orderBy('sl_no', 'asc');
        if($des_type != '')
        {
        $desig = $desig->where('des_type', 'like', '%' . $des_type . '%');
        }
        
        if($des_nm != '')
        {
            // dd($des_nm);
            $desig = $desig->where('des_nm', 'like', '%' . $des_nm . '%');
        }
        if($state_nm != '')
        {
        $desig = $desig->where('state_nm', 'like', '%' . $state_nm . '%');
        }
        $desig = $desig->paginate(50);
        // dd($kl[0]->des_type);
       
        return view ('admin.masterentry.adminDesignationPlace',compact('desig','state'));
    }

    

    public function adminDesig(Request $request)
    {
        $request->validate([
            'des_type' => 'required',
            'sl_no' => 'required',
            'des_nm' => 'required',
            'des_no_post' => 'required',
            
        ],
        [
            'des_type.required' => 'Designation Type is required',
            'sl_no.required' => 'Serial No is required ',
            'des_nm.required' => 'Designation Name  is required ',
            'des_no_post.required' => 'No of post is requirfd',
        ]);

        $check_desig_cnt =  DB::table('desig_mast')
            ->where('state_id', $request->state_id)
            ->where('des_type', $request->des_type)
            ->where('des_nm', $request->des_nm)
            ->where('sl_no', $request->sl_no)
            ->count();

            // dd( $check_desig );
        if( $check_desig_cnt < 1 ){

            $check_desig_cnt_2 =  DB::table('desig_mast')
            ->where('state_id', $request->state_id)
            ->where('des_type', $request->des_type)
            ->where('sl_no', $request->sl_no)
            ->count();

            if( $check_desig_cnt_2 < 1 ){
                $max_des_id = Designation::orderBy('des_id', 'desc')->value('des_id');
                // dd($max_des_id );

                if($max_des_id=="")
                {
                    $des_id = "DIG0001";
                }
                else{
        
                    $lastp = substr($max_des_id,3,4);
                    $lastpp = ++$lastp;
                    $last = str_pad($lastpp,4,"0",STR_PAD_LEFT);
                    $des_id = 'DIG'.$last;
                }
                // dd($des_id );

                // $k = $request->state_nm;
                // dd($k);
            
            
                $state_id =$request->state_id;
                $state_dtl = DB::table('state_mast')->where('state_id', $state_id)->select('state_nm','state_code')->first();
                // dd($state_dtl->state_nm);
                $state_nm =  $state_dtl->state_nm;
                $state_code =$state_dtl->state_code;

                // dd($state_code, $state_nm ,$state_id);

                $user = Designation::insert([
                    'des_id'=>$des_id,
                    'des_type' => $request->des_type,
                    'sl_no' => $request->sl_no,
                    'des_nm' =>Str::upper( $request->des_nm),
                    'des_no_post' => $request->des_no_post,
                    'state_id'=>$state_id,
                    'state_nm'=> $state_nm,
                    'state_code' => $state_code
                ]);
                return redirect()->route('ad.designation')->with('msg','Designation place wise has been created successfully');
            }
            else{
                return redirect()->route('ad.designation')->with('msg','This serial no already exists under same designation type');
            }
           
        }
        else{
            return redirect()->route('ad.designation')->with('msg','This Designation already exists under same combination');
          
        }
    }

    public function desigEdit($id)
    {
        $desig_edit = Designation::where('des_id', $id)
            ->select('des_type','sl_no','des_nm','des_no_post','state_id','des_id')
            ->first();
       return view('admin.masterentry.adminDesignationEdit',compact('desig_edit'));
    }

    public function desigEditUp(Request $request)
    {
        $des_id = $request->des_id;
        // dd($des_id);
        $desig_edit = Designation::where('des_id',$request->des_id)
            // ->first()
            // dd($desig_edit);
            ->update([
                'des_id' =>  $des_id,
                'des_no_post' => $request->des_no_post
            ]);
            return redirect()->route('ad.designation')->with('msg','Designation place wise has been updated successfully');
    }

    public function desigDelete($id)
    {
        $del = Designation::where('des_id',$id)
        ->delete();
        // ->first();
        // dd($del );
        return redirect()->route('ad.designation')->with('msg','Designation place wise has been deleted successfully');
    }

    public function adminOrganiser()
    {
        $organiser_nm = request('organiser_nm');
        
        $organi = DB::table('organiser_mast')->where('organiser_stat','A')
            ->orderBy('organiser_nm', 'asc');
        // dd( $organi[0]->organiser_id);
        if($organiser_nm != '')
        {
            $organi = $organi->where('organiser_nm', 'like', '%' . $organiser_nm . '%');
        }
        $organi = $organi->get();
        // dd( $organiser_nm);
        return view ('admin.masterentry.adminOrganiser',compact('organi'));
    }

    public function organiserAdd(Request $request)
    {
        $max_organiser_id = DB::table('organiser_mast')->orderBy('organiser_id', 'desc')->value('organiser_id');
        // dd($max_organiser_id );

        if($max_organiser_id=="")
        {
            $organiser_id = "OG0001";
        }
        else{
  
            $lastp = substr($max_organiser_id,2,4);
            $lastpp = ++$lastp;
            $last = str_pad($lastpp,4,"0",STR_PAD_LEFT);
            $organiser_id = 'OG'.$last;
        }
        // dd($organiser_id );

        $user = organiser::create([
            'organiser_id'=>$organiser_id,
            'organiser_nm' => $request->organiser_nm,
        ]);

        return redirect()->route('add.Organiser')->with('msg','Organiser has been created successfully');  
    }

    public function organiserDelete($id)
    {
        $del = organiser::where('organiser_id',$id)
          // dd($del );
        ->delete();
        // ->first();
        // dd($del );
        return redirect()->route('add.Organiser')->with('msg','Organiser has been deleted successfully');
    }

    public function adminAddDistrict()
    {
        $district_nm = request('district_nm');
        $state_nm = request('state_nm');
        // dd( $state_nm);

        $state = DB::table('state_mast')->select('state_nm','state_code','state_id')
        ->get();
        // dd( $state);

        $query = DB::table('district_mast')
            ->orderBy('district_nm', 'asc');
            if($district_nm != '')
            {
                $query = $query->where('district_nm', 'like', '%' . $district_nm . '%');
            }
            if($state_nm != '')
            {
                $query = $query->where('state_nm', 'like', '%' . $state_nm . '%');
            }
            $district = $query->paginate(50);
        // dd( $district[0]->district_nm);
        return view ('admin.masterentry.adminDistrict',compact('district','state'));
    }

    public function districtsAdd(Request $request)
    {
        $request->validate([
            'state_id' => 'required',
            'district_nm' => 'required',
        ],
        [
            'state_id.required' => 'State name is required',
            'district_nm.required' => 'District name is required ',
        ]);

        $check_dis_cnt =  DB::table('district_mast')
        ->where('state_id', $request->state_id)
        ->where('district_nm', $request->district_nm)
        ->count();

        // dd( $check_dis_cnt );
    if( $check_dis_cnt < 1 ){

        $max_district_id = DB::table('district_mast')->orderBy('district_id', 'desc')->value('district_id');
        // dd($max_district_id );

        if($max_district_id=="")
        {
            $district_id = "DS0001";
        }
        else{
  
            $lastp = substr($max_district_id,2,4);
            $lastpp = ++$lastp;
            $last = str_pad($lastpp,4,"0",STR_PAD_LEFT);
            $district_id = 'DS'.$last;
        }
        // dd($district_id );
      
        
            $state_id =$request->state_id;
            $state_dtl = DB::table('state_mast')->where('state_id', $state_id)->select('state_nm','state_code')->first();
            // dd($state_dtl->state_nm);
            $state_nm =  $state_dtl->state_nm;
            $state_code =$state_dtl->state_code;

            $user = district::insert([
                'district_id'=>$district_id,
                'district_nm' =>Str::upper($request->district_nm),
                'state_id'=>$state_id,
                'state_nm'=>$state_nm,
                'state_code'=>$state_code
            ]);

            return redirect()->route('add.District')->with('msg','District has been created successfully'); 
        }
        else{
            return redirect()->route('add.District')->with('msg','District in same state already exists '); 
        }   
    }

    public function districtEdit($id)
    {
        $dis_edit = district::where('district_id', $id)->first();
        // dd($dis_edit);
        return view('admin.masterentry.adminDistrictEdit',compact('dis_edit'));
    }

    public function districtsUp(Request $request)
    {
        $district_id = $request->district_id;
        // dd($district_id);
        $dis_edit = district::where('district_id',$request->district_id)
            // ->first()
            // dd($dis_edit);
            ->update([
                'district_id' =>  $district_id,
                'district_nm' => Str::upper($request->district_nm),
            ]);
            return redirect()->route('add.District')->with('msg','District has been updated successfully');
    }

    public function districtDelete($id)
    {
        $del = district::where('district_id',$id)
          // dd($del );
        ->delete();
        // ->first();
        // dd($del );
        return redirect()->route('add.District')->with('msg','District has been deleted successfully');
    }

    public function adminAddBlock()
    {
        $district_nm = request('district_nm');
        $block_nm = request('block_nm');
        $state_id = request('state_id');
        // dd($state_id,$district_nm, $block_nm);

        $query = DB::table('block_mast')
        ->orderBy('block_nm', 'asc');
        // ->get();
        if($district_nm != '')
        {
            $query = $query->where('district_nm', 'like', '%' . $district_nm . '%');
        }
        // dd($district_nm);

        if($block_nm != '')
        {
            $query = $query->where('block_nm', 'like', '%' . $block_nm . '%');
        }
        if($state_id != '')
        {
            $query = $query->where('state_id', $state_id );
        }
        $block =  $query->paginate(50);
        // dd($block[0]->block_nm);

        $state = DB::table('state_mast')->select('state_nm','state_code','state_id')
        ->get();
        // dd( $state);
        // $dist = DB::table('district_mast')->get();
        return view ('admin.masterentry.adminBlock',compact('block','state'));
    }
   
    public function findDisName(Request $r)
    {
        if($r->ajax())
        {
            $state_id_1 = $r->state_id_1;
            $district_nm_1 = DB::table('district_mast')->where('state_id',$state_id_1)
                ->orderBy('district_nm')
                ->get();
            // dd(  $district_nm_1);
            return $district_nm_1;
        }
    }

    public function searDisName(Request $r)
    {
        if($r->ajax())
        {
            $state_id_22 = $r->state_id_22;
            // dd($state_id_22);
            $district_nm_22 = DB::table('district_mast')->where('state_id',$state_id_22)
                ->orderBy('district_nm')
                ->get();
            // dd($district_nm_22);
            return $district_nm_22;
        }
    }


    public function blockAdd(Request $request)
    {
        $request->validate([
            'state_id' => 'required',
            'district_nm' => 'required',
            'block_nm' => 'required'
        ],
        [
            'state_id.required' => 'State name is required',
            'district_nm.required' => 'District name is required ',
            'block_nm.required' => 'Block name is required'
        ]);

        $check_block_cnt =  DB::table('block_mast')
        ->where('state_id', $request->state_id)
        ->where('district_nm', $request->district_nm)
        ->where('block_nm', $request->block_nm)
        ->count();
        // dd( $check_block_cnt );

        if( $check_block_cnt < 1 ){
            $max_block_id = DB::table('block_mast')->orderBy('block_id', 'desc')->value('block_id');
            // dd($max_block_id );

            if($max_block_id=="")
            {
                $block_id = "BL0001";
            }
            else{
    
                $lastp = substr($max_block_id,2,4);
                $lastpp = ++$lastp;
                $last = str_pad($lastpp,4,"0",STR_PAD_LEFT);
                $block_id = 'BL'.$last;
            }
            // dd($block_id );
            $state_id =request('state_id');
            $dist = DB::table('district_mast')->where('state_id', $state_id)->select('state_nm','state_code')->first();
            // dd($dist->state_nm);
            

            $user = block::insert([
                'block_id'=>$block_id,
                'block_nm' =>Str::upper($request->block_nm),
                'district_nm' => $request->district_nm,
                'state_id' => $state_id,
                'state_nm' =>  $dist->state_nm,
                'state_code' => $dist->state_code
            ]);

            return redirect()->route('add.Block')->with('msg','Block has been created successfully'); 
        }
        else{
            return redirect()->route('add.Block')->with('msg','Block name already exists'); 

        }   
    }

    public function blockEdit($id)
    {
        $block_edit = DB::table('block_mast')->where('block_id',$id)->first();

        $distric = DB::table('district_mast')
        ->orderBy('district_nm')
        ->get();

        return view('admin.masterentry.adminBlockEdit',compact('block_edit','distric'));
    }

    public function blockUp(Request $request)
    {
        $check_block_cnt =  DB::table('block_mast')
        ->where('block_nm', $request->block_nm)
        ->count();
        // dd( $check_block_cnt );

        if( $check_block_cnt < 1 ){
            $block_id = $request->block_id;
            // dd($block_id);
            $block_edit_up = block::where('block_id', $block_id )
                // ->first();
                // dd($block_edit_up);
                ->update([
                    'block_id' =>  $block_id,
                    'block_nm' => $request->block_nm,
                    // 'district_nm' => $request->district_nm,
                ]);
                return redirect()->route('add.Block')->with('msg','Block has been updated successfully');
        }
        else{
            return redirect()->route('add.Block')->with('msg','Block name already exists');
        }        
    }

    public function blockDelete($id)
    {
        $del = block::where('block_id',$id)
          // dd($del );
        ->delete();
        // ->first();
        // dd($del );
        return redirect()->route('add.Block')->with('msg','Block has been deleted successfully');
    }
    public function adminAddStaff()
    {
        $f_nm = request('f_nm');
        $l_nm = request('l_nm');
        //   dd($l_nm);
        $query = DB::table('staff_mast');
        if($f_nm != '')
        {
            $query =$query->where('f_nm', 'like', '%' . $f_nm . '%');
        }
        if($l_nm != '')
        {
          
            $query=$query->where('l_nm','like', '%'.$l_nm.'%' );
        }
        $staff =$query->get();
        $total_staff = count($staff);
        // dd( $total_staff);
        return view ('admin.masterentry.adminStaff',compact('staff','total_staff'));
    }

    public function staffEdit($id)
    {
        $staff_edit = DB::table('staff_mast')->where('staff_id',$id)->first();
        // dd(  $staff_edit->staff_land_no);
        return view('admin.masterentry.adminStaffEdit',compact('staff_edit'));

    }
    public function staffView($id)
    {
        $staff_view = DB::table('staff_mast')->where('staff_id',$id)->first();
        // dd(  $staff_view->staff_land_no);
        return view('admin.masterentry.adminStaffView',compact('staff_view'));

    }

    public function staffUp(Request $request)
    {
        $staff_id = $request->staff_id;
        // dd($staff_id);
        $query = staff::where('staff_id', $staff_id )
        ->update([
            'staff_id' =>  $staff_id,
            'f_nm' => $request->f_nm,
            'm_nm' => $request->m_nm,
            'l_nm' => $request->l_nm,
            'staff_e_mail' => $request->staff_e_mail,
            'staff_mob_1' => $request->staff_mob_1,
            'staff_land_no' => $request->staff_land_no,
            'staff_add' => $request->staff_add
        ]);
        return redirect()->route('add.Staff')->with('msg','Staff has been updated successfully');
    }
    public function staffSave(Request $request)
    {
        // $query = staff::where('staff_id', $staff_id )
        $max_staff_id = DB::table('staff_mast')->orderBy('staff_id', 'desc')->value('staff_id');
        // dd($max_staff_id );

        if($max_staff_id=="")
        {
            $staff_id = "SF00000001";
        }
        else{
  
            $lastp = substr($max_staff_id,2,8);
            $lastpp = ++$lastp;
            $last = str_pad($lastpp,8,"0",STR_PAD_LEFT);
            $staff_id = 'SF'.$last;
        }
        // dd($staff_id );
        // $sf = $request->m_nm;
        // dd($sf);
        $query = staff::insert([
            'staff_id'=>$staff_id,
            'f_nm' => Str::upper($request->f_nm) ,
            'm_nm' => Str::upper($request->m_nm) ,
            'l_nm' => Str::upper($request->l_nm),
            'staff_e_mail' => $request->staff_e_mail,
            'staff_mob_1' => $request->staff_mob_1,
            'staff_land_no' => $request->staff_land_no,
            'staff_add' => $request->staff_add
        ]);

        return redirect()->route('add.Staff')->with('msg','Staff has been created successfully');
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
            'user_group' => 'required',
            'admin_name' => 'required',
            'admin_user_id' => 'required|string|max:255|unique:admin_user',
            'email' => 'required|string|email|max:255|unique:admin_user',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'plain_password' => 'required'
        ]);
        // [
        //     'user_group.required' => 'User group is required ',
        //     'admin_user_id.required' => 'User id is requirfd',
        //     'email' => 'Email is required',
        //     'password' => 'Password is required',
        // ]);
        $user_group =$request->user_group;
        // dd($user_group);

        $max_admin_id = DB::table('admin_user')->orderBy('admin_id','desc')->value('admin_id');
        if($max_admin_id=="")
        {
            $admin_id =  "AD000001";
        }
        else{
  
            $lastp = substr($max_admin_id,2,6);
            $lastpp = ++$lastp;
            $last = str_pad($lastpp,6,"0",STR_PAD_LEFT);
            $admin_id  = 'AD' . $last;
          }

  
        // $plain_password = $request->state_nm;
        // dd($plain_password );
          $user = Admin::insert([
            'admin_id'=>$admin_id,
            'user_group' => $request->user_group,
            'admin_name' => Str::upper($request->admin_name),
            'user_gender' => $request->user_gender,
            'admin_user_id' => Str::upper($request->admin_user_id) ,
            'email' => Str::lower($request->email),
            'password' => Hash::make($request->password),
            'plan_password' => $request->password,
            'created_at'=>    date("Y/m/d  h:i:s"),
            'updated_at' => date("Y/m/d  h:i:s")
        ]);

        $max_permission_id = DB::table('user_permisiion_mast')->orderBy('permission_id','desc')->value('permission_id');
        if($max_permission_id=="")
        {
            $permission_id =  "PR000001";
        }
        else{
  
            $lastp = substr($max_permission_id,2,6);
            $lastpp = ++$lastp;
            $last = str_pad($lastpp,6,"0",STR_PAD_LEFT);
            $permission_id  = 'PR' . $last;
          }
        // dd($max_permission_id);
        // $user_info = DB::table('admin_user')->select('admin_id','admin_user_id')->first();
        // dd($user_info->admin_user_id);
        $user_permi = AdminUserPermission::insert([
            'permission_id'=>$permission_id,
            'admin_id'=>$admin_id,
            'admin_user_id' => Str::upper($request->admin_user_id) ,
            'user_group' => $request->user_group,
            'main_per'=> "G",
            'state_per' => 'R',
            'membership_per' => "R",
            'master_per' => "R",
            'function_per' => "R",
            'mail_per' => "R",
            'created_at'=>    date("Y/m/d  h:i:s"),
            'updated_at' => date("Y/m/d  h:i:s")
        ]);

        
        return redirect()->route('add.Creuser')->with('msg','Users has been created successfully');
    }
}
