<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class galleryController extends Controller
{
    public function gallShow()
    {
        $gallery=DB::table('image_mast')->where('img_type','gallery_photo')->get();
        return view('galleryPic',compact('gallery'));
    }

    public function contactUs()
    {
        return view('contactUs');
    }

    public function contactUsMsg(Request $request)
    {
        // $vst_nm = $request->vst_nm;
        // $vst_email = $request->vst_email;
        // $vst_office = $request->vst_office;
        // $vst_ph_no = $request->vst_ph_no;
        // $vst_msg = $request->vst_msg;
        // $msg_dt = date('d/m/Y');
        // $msg_time = date('H:i:s');
        // dd($msg_dt, $msg_time);
        $request->validate([
            'vst_nm' => 'required',
            'vst_email' => 'required',
            'vst_office' => 'required',
            'vst_ph_no' => 'required',
            'vst_msg' => 'required',
        ],
        [
                'vst_nm.required' => 'Your Name is Required ',
                'vst_email.required' => 'Your Email is Requirfd',
                'vst_office.required' => 'Your Office is Required',
                'vst_ph_no.required' => 'Your Phone No is Required',
                'vst_msg.required' => 'Your Message is Required ',

            ]);

        $max_msg_id = DB::table('msg_mast')->orderBy('msg_id', 'desc')->value('msg_id');
        if($max_msg_id=="")
        {
            $msg_id = "MSG0000000001";
        }
        else{
  
            $lastp = substr($max_msg_id,3,10);
            $lastpp = ++$lastp;
            $last = str_pad($lastpp,10,"0",STR_PAD_LEFT);
            $msg_id = 'MSG'.$last;
          }

          $msg =  DB::table('msg_mast')->insert([
            'msg_id'=>$msg_id,
            'vst_nm' =>$request->vst_nm,
            'vst_email'=>$request->vst_email,
            'vst_office'=>$request->vst_office,
            'vst_ph_no'=>$request->vst_ph_no,
            'vst_msg'=>$request->vst_msg,
            'msg_dt'=> date('d/m/Y'),
            'msg_time'=> date('H:i:s')
        ]);
        return redirect()->route('contact.us')->with('msg','Your Message has been submitted successfully');

    }

    public function searchMem()
    {
        $mem_nm = request('mem_nm');
        $guard_nm = request('guard_nm');
        
        if ( $mem_nm &&  $guard_nm !='')
         {
            $query = DB::table('fcpm_mast_web');
            if($mem_nm != '')
            {
                $query =$query->where('mem_nm', $mem_nm );
    
            }
            if($guard_nm != '')
            {
                $query =$query->where('guard_nm', $guard_nm );
    
            }
            $mem =$query->get();
            $total_mem = count($mem);
            return view('searchMember',compact('mem','total_mem'));
        }
        else {
          
            return "Please Type All details...";


        }
       
       
       
    }
}
