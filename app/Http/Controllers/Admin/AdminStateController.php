<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\State;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use DB;
use App\Models\StateUsers\StUsers;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\JhApplicant;
use App\Models\Admin\BrApplicant;
use App\Models\Admin\wbApplicant;






class AdminStateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function adminStateMain()
    {
        return view ('admin.state.adminStateMainPage');
    }

    public function adminState()
    {
        return view ('admin.state.adminState');
    }


    public function addState(Request $req)
    {
        // $st_id = $req->state_nm = substr( $st_id ,2);
        // dd($st_id);

        $validated = $req->validate([
            'state_code' => 'required|max:2',
            'state_nm' => 'required | unique:state_mast',
            'head_off_nm' => 'required',
            'contact_no' => 'required|integer',
            'Banner_one' => 'image|mimes:jpg,png|max:2048',
            'Banner_two' => 'image|mimes:jpg,png|max:2048',
            'Banner_three' => 'image|mimes:jpg,png|max:2048'
        ],
        [
            'state_code.required' => 'State code is required',
            'state_nm.required' => 'State Name is required ',
            'head_off_nm.required' => 'Head office is required ',
            'contact_no.required' => 'Contact no is requirfd',
            'Banner_one' => 'Banner one is required',
            'Banner_two' => 'Banner two is required',
            'Banner_three' => 'Banner three is required'
      ]);
    
        
        //************************  for create custom id in database **************************//
        $max_state_id = State::orderBy('state_id', 'desc')->value('state_id');
        // dd($max_state_id );
        if($max_state_id=="")
        {
            $state_id = "ST0000000001";
        }
        else{
  
            $lastp = substr($max_state_id,2,10);
            $lastpp = ++$lastp;
            $last = str_pad($lastpp,10,"0",STR_PAD_LEFT);
            $state_id = 'ST'.$last;
          }
        //   Data maove to folder

            $upload1 = $req->file('Banner_one');
            // $destinationPath = public_path('admin_state_upload_one');
            $filename1 = $state_id. '.' . $upload1->getClientOriginalExtension();
        // $filename = date('His'). '.' . $upload->getClientOriginalExtension(); 11/02/21
            $upload1->move(public_path('admin_state_upload_one'),$filename1);

            $upload2 = $req->file('Banner_two');
            $filename2 = $state_id. '.' . $upload2->getClientOriginalExtension();
        // $filename = date('His'). '.' . $upload->getClientOriginalExtension(); 11/02/21
            $upload2->move(public_path('admin_state_upload_two'), $filename2);

            $upload3 = $req->file('Banner_three');
            $filename3 = $state_id. '.' . $upload3->getClientOriginalExtension();
        // $filename = date('His'). '.' . $upload->getClientOriginalExtension(); 11/02/21
            $upload3->move(public_path('admin_state_upload_three'), $filename3);

          //********************* connect database with help of models and save the data ****************/ 
         
        $states= new State;
        $states->state_id=$state_id;
        $states->state_nm = Str::upper($req-> state_nm);
        $states ->state_code = Str::upper($req-> state_code);
        $states->head_off_nm = Str::upper($req-> head_off_nm);
        $states->contact_no = $req->contact_no;
        $states->Banner_one = $filename1;
        $states->Banner_two=$filename2;
        $states->Banner_three=$filename3;
        $states->color_nm=$req->color_nm;
        $states->save();
        return redirect()->route('admin.state')->with('msg','State has been created successfully');
    }
    
    public function adminStateView()
    {
        $state_id = request('state_id');
        $state_nm = request('state_nm');
        // if( $state_id !=''|| $state_nm !='')
        // {
            $query  = State::query();
            // dd($query);
            $all_state = '';
            if($state_id != '')
            {
              $query = $query->where('state_id', 'like', '%' . $state_id . '%');
            }
            if($state_nm != '')
            {
              $query = $query->where('state_nm', 'like', '%' . $state_nm . '%');
            }
            $query =  $query->select('state_id','state_nm','head_off_nm','contact_no','color_nm','Banner_one','Banner_two','Banner_three');
            $stateview = $query->paginate(10);
            $state_total = count( $stateview);
            // dd( $state_total);
            $stateview->appends([
                'state_id' =>$state_id,
                'state_nm' =>$state_nm,
            ]);
        // }
        // else
        // {
        //     $stateview=[]; 
        // }
        return view ('admin.state.adminStateView',compact('stateview','state_total'));
    }
    public function StateEdit($id)
    {
         $stateedit = State::where('state_id', $id)->first();
         //$studyedits = StudyMaterial::find($id);
         //dd( $studyedits, $id);
         $state_id=request('state_id');
        $state_nm = request('state_nm');
        $head_off_nm = request('head_off_nm');
        $contact_no = request('contact_no');
        $Banner_one = request('Banner_one');
        $Banner_two = request('Banner_two');
        $Banner_three = request('Banner_three');
        $color_nm = request('color_nm');

        // return $state_id;
        return view('admin.state.adminStateEdit',compact('state_id','stateedit','state_nm','head_off_nm','contact_no','Banner_one','Banner_two','Banner_three','color_nm'));
    }

    public function adminStateEditUp(Request $request)
     {
        $state_id=request('state_id1');
        $state_nm=request('state_nm1');
        $head_off_nm = request('head_off_nm1');
        $contact_no = request('contact_no1');
        $color_nm =  request('color_nm1');
// dd( $request->state_id);
        $Banner_file=State::where('state_id', $request->state_id)->first();
    //   dd($Banner_file);
    if($request->file('Banner_one') != "" && $Banner_file->Banner_one != "")
        {
        unlink(public_path('admin_state_upload_one/'.$Banner_file->Banner_one));
        $upload = $request->file('Banner_one');
        $filename1 =$request->state_id. '.' . $upload->guessExtension();
        //$filename1 = date('His'). '.' . $upload->getClientOriginalExtension();
        $upload->move(public_path('admin_state_upload_one'), $filename1);
        }
        elseif($request->file('Banner_one') != "")
        {
            $upload = $request->file('Banner_one');
            $filename1 =$request->state_id. '.' . $upload->guessExtension();
            //$filename1 = date('His'). '.' . $upload->getClientOriginalExtension();
            $upload->move(public_path('admin_state_upload_one'), $filename1);
        }
        elseif($request->file('Banner_one') == "")
        {
            $filename1 = $Banner_file->Banner_one;
        }

    if($request->file('Banner_two') != "" && $Banner_file->Banner_two != "")
        {
        unlink(public_path('admin_state_upload_two/'.$Banner_file->Banner_two));
        $upload2 = $request->file('Banner_two');
        // $filename =$request->state_id. '.' . $upload->getClientOriginalExtension();
        $filename2 = $state_id. '.' . $upload2->getClientOriginalExtension();

        //$filename = date('His'). '.' . $upload->getClientOriginalExtension();
        $upload2->move(public_path('admin_state_upload_two'), $filename2);
        }
        elseif($request->file('Banner_two') != "")
            {
            $upload2 = $request->file('Banner_two');
            $filename2 =$request->state_id. '.' . $upload2->getClientOriginalExtension();
            //$filename = date('His'). '.' . $upload->getClientOriginalExtension();
            $upload2->move(public_path('admin_state_upload_two'), $filename2);
            }
        elseif($request->file('Banner_two') == "")
        {
            $filename2 = $Banner_file->Banner_two;
        }
        // dd($filename);
    if($request->file('Banner_three') != "" && $Banner_file->Banner_three != "")
        {
        unlink(public_path('admin_state_upload_three/'.$Banner_file->Banner_three));
        $upload3 = $request->file('Banner_three');
        $filename3 =$request->state_id. '.' . $upload3->getClientOriginalExtension();
        //$filename3 = date('His'). '.' . $upload->getClientOriginalExtension();
        $upload3->move(public_path('admin_state_upload_three'), $filename3);
        }
        elseif($request->file('Banner_three') != "")
            {
            $upload3 = $request->file('Banner_three');
            $filename3 =$request->state_id. '.' . $upload3->getClientOriginalExtension();
            //$filename3 = date('His'). '.' . $upload->getClientOriginalExtension();
            $upload3->move(public_path('admin_state_upload_three'), $filename3);
            }
        elseif($request->file('Banner_three') == "")
            {
            $filename3 = $Banner_file->Banner_three;
            }
      $editstate=State::where('state_id', $request->state_id)->first();
      //$editstate->state_id=$request->state_id;
    //   $editstate->state_nm=$request->state_nm;
      $editstate->head_off_nm=$request->head_off_nm;
      $editstate->contact_no=$request->contact_no;
      $editstate->color_nm = $request->color_nm;
      $editstate->Banner_one =$filename1;
      $editstate->Banner_two =$filename2;
      $editstate->Banner_three =$filename3;
      $editstate->save();
      return redirect()->route('admin.state-view',['state_nm'=>$state_nm,'state_id'=>$state_id,'head_off_nm'=>$head_off_nm, 'contact_no'=>$contact_no, 'color_nm'=>$color_nm])->with('msg','State has been Updated successfully !!!');;
    }

    public function adminCreateStateUser()
    {
        $all_state = DB::table('state_mast')->select('state_nm','state_code')->get();
        // dd($all_state);
        return view ('admin.state.adminCreateStateUser',compact('all_state'));
    }

    public function addCreateStateUser(Request $request)
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
       
        return redirect()->route('add.CreuserState')->with('msg','State users has been created successfully');
    }

    public function InsertData()
    {
        $InData= JhApplicant::get();
        // dd($InData);
        return view('admin.state.insertData',compact('InData'));
    
    }

    public function InsertUPData(Request $request)
    {
        // dd('fdsd');
        JhApplicant::all()->each(function($web) { 
            $wb = new wbApplicant; 
            $wb->mem_id = $web->mem_id;
            $wb->application_no = $web->application_no;
            $wb->mem_id_old = $web->mem_id_old;
            $wb->state_id = $web->state_id;
            $wb->state_code = $web->state_code;
            $wb->state_nm = $web->state_nm;
            $wb->mem_nm=Str::upper($web->mem_nm);
            $wb->mem_add=Str::upper($web->mem_add);
            $wb->district=$web->district_nm;
            $wb->guard_relatiion=$web->guard_relatiion;
            $wb->guard_nm=Str::upper($web->guard_nm);
            $wb->mem_quali=Str::upper($web->mem_quali);
            $wb->contact_no=$web->contact_no;
            $wb->mem_email=$web->mem_email;
            $wb->birth_dt=$web->birth_dt;
            $wb->mem_cast=Str::upper($web->mem_cast);
            $wb->gender=$web->gender;
            $wb->media_nm=Str::upper($web->media_nm);
            $wb->memo_no=$web->memo_no;
            $wb->mem_desig=$web->mem_desig;
            $wb->entry_dt=$web->entry_dt;
            $wb->mem_posting_place=$web->mem_posting_place;
            $wb->profile_pic=$web->profile_pic;
            $wb->mem_stat=$web->mem_stat;
            $wb->export_stat=$web->export_stat;
            $wb->des_type=$web->des_type;
            $wb->sl_no=$web->sl_nos;
            $wb->rand_no=$web->rand_no;
            $wb->memo_id=$web->memo_id;
            $wb->mem_aadhar_no=$web->mem_aadhar_no;
            $wb->mem_pan_no=Str::upper($web->mem_pan_no);
            $wb->mem_voterid_no=Str::upper($web->mem_voterid_no);
            $wb->bank_acount_no=$web->bank_acount_no;
            $wb->mem_bank_nm=Str::upper($web->mem_bank_nm);
            $wb->bnk_ifsc_code=Str::upper($web->bnk_ifsc_code);
            $wb->mail_stat=$web->mail_stat;
            $wb->comm_stat=$web->comm_stat;
            $wb->joi_rand_no=$web->joi_rand_no;
            $wb->joi_memo_id=$web->joi_memo_id;
            $wb->add_lane=$web->add_lane;
            $wb->add_city=$web->add_city;
            $wb->add_postofc=$web->add_postofc;
            $wb->add_ps=$web->add_ps;
            $wb->add_dist=$web->add_dist;
            $wb->add_pin=$web->add_pin;
            $wb->post_applied_for=$web->post_applied_for;
            $wb->reg_status=$web->reg_status;
            $wb->mem_cast_new=$web->mem_cast_new;
            $wb->profile_pic_new=$web->profile_pic_new;
            $wb->mem_aadhar_no_new=$web->mem_aadhar_no_new;
            $wb->mem_pan_no_new=$web->mem_pan_no_new;
            $wb->mem_voterid_no_new=$web->mem_voterid_no_new;
            $wb->add_ps_new=$web->add_ps_new;
            $wb->add_dist_new=$web->add_dist_new;
            $wb->add_pin_new=$web->add_pin_new;
            $wb->pre_add_lane=$web->pre_add_lane;
            $wb->pre_add_city=$web->pre_add_city;
            $wb->pre_add_postofc=$web->pre_add_postofc;
            $wb->pre_add_ps=$web->pre_add_ps;
            $wb->pre_add_dist=$web->pre_add_dist;
            $wb->pre_add_pin=$web->pre_add_pin;
            $wb->sign_image=$web->sign_image;
            $wb->mem_age=$web->mem_age;
            $wb->mem_exam_1=$web->mem_exam_1;
            $wb->mem_exam_pass_1=$web->mem_exam_pass_1;
            $wb->mem_exam_div_1=$web->mem_exam_div_1;
            $wb->mem_exam_percent_1=$web->mem_exam_percent_1;
            $wb->mem_exam_2=$web->mem_exam_2;
            $wb->mem_exam_pass_2=$web->mem_exam_pass_2;
            $wb->mem_exam_div_2=$web->mem_exam_div_2;
            $wb->mem_exam_percent_2=$web->mem_exam_percent_2;
            $wb->mem_exam_3=$web->mem_exam_3;
            $wb->mem_exam_pass_3=$web->mem_exam_pass_3;
            $wb->mem_exam_div_3=$web->mem_exam_div_3;
            $wb->mem_exam_percent_3=$web->mem_exam_percent_3;
            $wb->mem_exam_4=$web->mem_exam_4;
            $wb->mem_exam_pass_4=$web->mem_exam_pass_4;
            $wb->mem_exam_div_4=$web->mem_exam_div_4;
            $wb->mem_exam_percent_4=$web->mem_exam_percent_4;
            $wb->mem_exam_5=$web->mem_exam_5;
            $wb->mem_exam_pass_5=$web->mem_exam_pass_5;
            $wb->mem_exam_div_5=$web->mem_exam_div_5;
            $wb->mem_exam_percent_5=$web->mem_exam_percent_5;
            $wb->mem_exam_6=$web->mem_exam_6;
            $wb->mem_exam_pass_6=$web->mem_exam_pass_6;
            $wb->mem_exam_div_6=$web->mem_exam_div_6;
            $wb->mem_exam_percent_6=$web->mem_exam_percent_6;
            $wb->driver_post=$web->driver_post;
            $wb->driver_licence_no=$web->driver_licence_no;
            $wb->driver_licence_cat=$web->driver_licence_cat;
            $wb->driver_exp=$web->driver_exp;
            $wb->comp_quali=$web->comp_quali;
            $wb->lang_known=$web->lang_known;
            $wb->mem_exp=$web->mem_exp;
            $wb->name_of_the_board_1=$web->name_of_the_board_1;
            $wb->name_of_the_board_2=$web->name_of_the_board_2;
            $wb->name_of_the_board_3=$web->name_of_the_board_3;
            $wb->name_of_the_board_4=$web->name_of_the_board_4;
            $wb->name_of_the_board_5=$web->name_of_the_board_5;
            $wb->name_of_the_board_6=$web->name_of_the_board_6;
            $wb->add_lane_new=$web->add_lane_new;
            $wb->add_city_new=$web->add_city_new;
            $wb->add_postofc_new=$web->add_postofc_new;
            $wb->select_stat=$web->select_stat;
            $wb->dec_memo_id=$web->dec_memo_id;
            $wb->dec_rand_no=$web->dec_rand_no;
            $wb->app_memo_id=$web->app_memo_id;
            $wb->app_rand_no=$web->app_rand_no;
            // $wb->state_nm=$web->state_name;
            $wb->mail_count=$web->mail_count;
            $wb->save();
        });
        return redirect()->route('insert.data')->with('msg','Import complited successfully');
    }
    
    
    public function InsertDataBihar()
    {
        $InData= BrApplicant::get();
        // dd($InData);
        return view('admin.state.insertData',compact('InData'));
    
    }
    public function InsertUPDataBr(Request $request)
    {
        // dd('sp');
        BrApplicant::all()->each(function($web) { 
            $br = new wbApplicant; 
            $br->mem_id = $web->mem_id;
            $br->application_no = $web->application_no;
            $br->mem_id_old = $web->mem_id_old;
            $br->state_id = $web->state_id;
            $br->state_code = $web->state_code;
            $br->state_nm = $web->state_nm;
            $br->mem_nm=Str::upper($web->mem_nm);
            $br->mem_add=Str::upper($web->mem_add);
            $br->district=$web->district_nm;
            $br->guard_relatiion=$web->guard_relatiion;
            $br->guard_nm=Str::upper($web->guard_nm);
            $br->mem_quali=Str::upper($web->mem_quali);
            $br->contact_no=$web->contact_no;
            $br->mem_email=$web->mem_email;
            $br->birth_dt=$web->birth_dt;
            $br->mem_cast=Str::upper($web->mem_cast);
            $br->gender=$web->gender;
            $br->media_nm=Str::upper($web->media_nm);
            $br->memo_no=$web->memo_no;
            $br->mem_desig=$web->mem_desig;
            $br->entry_dt=$web->entry_dt;
            $br->mem_posting_place=$web->mem_posting_place;
            $br->profile_pic=$web->profile_pic;
            $br->mem_stat=$web->mem_stat;
            $br->export_stat=$web->export_stat;
            $br->des_type=$web->des_type;
            $br->sl_no=$web->sl_nos;
            $br->rand_no=$web->rand_no;
            $br->memo_id=$web->memo_id;
            $br->mem_aadhar_no=$web->mem_aadhar_no;
            $br->mem_pan_no=Str::upper($web->mem_pan_no);
            $br->mem_voterid_no=Str::upper($web->mem_voterid_no);
            $br->bank_acount_no=$web->bank_acount_no;
            $br->mem_bank_nm=Str::upper($web->mem_bank_nm);
            $br->bnk_ifsc_code=Str::upper($web->bnk_ifsc_code);
            $br->mail_stat=$web->mail_stat;
            $br->comm_stat=$web->comm_stat;
            $br->joi_rand_no=$web->joi_rand_no;
            $br->joi_memo_id=$web->joi_memo_id;
            $br->add_lane=$web->add_lane;
            $br->add_city=$web->add_city;
            $br->add_postofc=$web->add_postofc;
            $br->add_ps=$web->add_ps;
            $br->add_dist=$web->add_dist;
            $br->add_pin=$web->add_pin;
            $br->post_applied_for=$web->post_applied_for;
            $br->reg_status=$web->reg_status;
            $br->mem_cast_new=$web->mem_cast_new;
            $br->profile_pic_new=$web->profile_pic_new;
            $br->mem_aadhar_no_new=$web->mem_aadhar_no_new;
            $br->mem_pan_no_new=$web->mem_pan_no_new;
            $br->mem_voterid_no_new=$web->mem_voterid_no_new;
            $br->add_ps_new=$web->add_ps_new;
            $br->add_dist_new=$web->add_dist_new;
            $br->add_pin_new=$web->add_pin_new;
            $br->pre_add_lane=$web->pre_add_lane;
            $br->pre_add_city=$web->pre_add_city;
            $br->pre_add_postofc=$web->pre_add_postofc;
            $br->pre_add_ps=$web->pre_add_ps;
            $br->pre_add_dist=$web->pre_add_dist;
            $br->pre_add_pin=$web->pre_add_pin;
            $br->sign_image=$web->sign_image;
            $br->mem_age=$web->mem_age;
            $br->mem_exam_1=$web->mem_exam_1;
            $br->mem_exam_pass_1=$web->mem_exam_pass_1;
            $br->mem_exam_div_1=$web->mem_exam_div_1;
            $br->mem_exam_percent_1=$web->mem_exam_percent_1;
            $br->mem_exam_2=$web->mem_exam_2;
            $br->mem_exam_pass_2=$web->mem_exam_pass_2;
            $br->mem_exam_div_2=$web->mem_exam_div_2;
            $br->mem_exam_percent_2=$web->mem_exam_percent_2;
            $br->mem_exam_3=$web->mem_exam_3;
            $br->mem_exam_pass_3=$web->mem_exam_pass_3;
            $br->mem_exam_div_3=$web->mem_exam_div_3;
            $br->mem_exam_percent_3=$web->mem_exam_percent_3;
            $br->mem_exam_4=$web->mem_exam_4;
            $br->mem_exam_pass_4=$web->mem_exam_pass_4;
            $br->mem_exam_div_4=$web->mem_exam_div_4;
            $br->mem_exam_percent_4=$web->mem_exam_percent_4;
            $br->mem_exam_5=$web->mem_exam_5;
            $br->mem_exam_pass_5=$web->mem_exam_pass_5;
            $br->mem_exam_div_5=$web->mem_exam_div_5;
            $br->mem_exam_percent_5=$web->mem_exam_percent_5;
            $br->mem_exam_6=$web->mem_exam_6;
            $br->mem_exam_pass_6=$web->mem_exam_pass_6;
            $br->mem_exam_div_6=$web->mem_exam_div_6;
            $br->mem_exam_percent_6=$web->mem_exam_percent_6;
            $br->driver_post=$web->driver_post;
            $br->driver_licence_no=$web->driver_licence_no;
            $br->driver_licence_cat=$web->driver_licence_cat;
            $br->driver_exp=$web->driver_exp;
            $br->comp_quali=$web->comp_quali;
            $br->lang_known=$web->lang_known;
            $br->mem_exp=$web->mem_exp;
            $br->name_of_the_board_1=$web->name_of_the_board_1;
            $br->name_of_the_board_2=$web->name_of_the_board_2;
            $br->name_of_the_board_3=$web->name_of_the_board_3;
            $br->name_of_the_board_4=$web->name_of_the_board_4;
            $br->name_of_the_board_5=$web->name_of_the_board_5;
            $br->name_of_the_board_6=$web->name_of_the_board_6;
            $br->add_lane_new=$web->add_lane_new;
            $br->add_city_new=$web->add_city_new;
            $br->add_postofc_new=$web->add_postofc_new;
            $br->select_stat=$web->select_stat;
            $br->dec_memo_id=$web->dec_memo_id;
            $br->dec_rand_no=$web->dec_rand_no;
            $br->app_memo_id=$web->app_memo_id;
            $br->app_rand_no=$web->app_rand_no;
            // $br->state_nm=$web->state_name;
            $br->mail_count=$web->mail_count;
            $br->save();
           
        });
        return redirect()->route('insert.data')->with('msg','Import complited successfully');
    }
}



