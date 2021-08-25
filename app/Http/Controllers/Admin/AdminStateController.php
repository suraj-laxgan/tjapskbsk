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
        $states->head_off_nm = $req->head_off_nm;
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
}



