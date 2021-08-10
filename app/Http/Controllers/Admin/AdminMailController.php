<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\wbApplicant;
use App\Models\Admin\BrApplicant;
use App\Models\Admin\JhApplicant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WestBengalMail;
use App\Mail\BiharMail;
use App\Mail\JharkhandMail;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\wbExport;
use App\Exports\brExport;
use App\Exports\jkExport;



class AdminMailController extends Controller
{
    public function allmail()
    {
        return view('admin.mail.allMail');
    }
    
    // ******* West Bengal Start *******

    public function mailwb()
    {
      $mem_id = request('mem_id');
      $application_no = request('application_no');
      $mem_nm = request('mem_nm');
      $post_applied_for = request('post_applied_for');
      $mem_email = request('mem_email');

      $query  = wbApplicant::query();
      $query = $query->where('reg_status', ['new']);

          if($application_no != '')
          {
            $query = $query->where('application_no', 'like', '%' . $application_no . '%');
          }
          if($mem_nm != '')
          {
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
          }
          if($mem_nm != '')
          {
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
          }
          if($post_applied_for != '')
          {
            $query = $query->where('post_applied_for', 'like', '%' . $post_applied_for . '%');
          }
          if($mem_id != '')
          {
            $query = $query->where('mem_id', 'like', '%' . $mem_id . '%');
          }
          $wbappli= $query->paginate(100);
          $wbappli->appends([
            'application_no' =>$application_no,
            'mem_nm' =>$mem_nm,
            'post_applied_for' =>$post_applied_for,
            'mem_id' => $mem_id,
            'mem_email' => $mem_email,
          ]);
        return view ('admin.mail.wBNewApplicantSeView',compact('wbappli'));
    }

    public function mailSendWb($mem_id)
    {
        $to_mail = DB::table('fcpm_mast')->where('mem_id',$mem_id)->select('mem_email','mem_nm','application_no','add_city','add_postofc','add_ps','add_dist')->first();
        wbApplicant::where('mem_id', $mem_id)
                        ->update([
                        'mail_count'=> DB::raw('mail_count+1'), 
                    ]);
        $send_email_from = DB::table('send_email_from')->value('send_email_from');
        $data = [
        'mem_id' => $mem_id,
        'from_email' => $send_email_from,
        'subject' => 'E Verification',
        'mem_nm'=>$to_mail->mem_nm,
        'application_no'=>$to_mail->application_no,
        'add_city'=>$to_mail->add_city,
        'add_postofc'=>$to_mail->add_postofc,
        'add_ps'=>$to_mail->add_ps,
        'add_dist'=>$to_mail->add_dist,
        'mem_email'=>$to_mail->mem_email
        ];
        //send to email
        // Mail::to('kbskdmt.hr@gmail.com')->send(new WestBengalMail($data));

        Mail::to($to_mail->mem_email)->cc(['kbskdmt.hr@gmail.com'])->send(new WestBengalMail($data));

        return redirect()->route('add.mailWb')->with('msg','Mail Send Successfully');
    }

    public function previewPrintWb($mem_id)
    {
      $mail_preview = DB::table('fcpm_mast')->where('mem_id',$mem_id)->first();
      return view('admin.mail.preview',compact('mail_preview'));
    }

    public function generateWbPDF()
    {
      $mem_id = request('mem_id');
      $mail_down = DB::table('fcpm_mast')->where('mem_id',$mem_id)->first();
      // dd($mail_down);
       $pdf = PDF::loadView('admin.mail.mailsend.pdfmailbodyWb',compact('mail_down'));  
      //  return $pdf->download('E-Verification.pdf');  
        return $pdf->stream('E-Verification.pdf');
    }

    public function wbExcel()
    {
        return Excel::download(new wbExport, 'members.xlsx');
    }
    // ####### WestBengal End #########

    // ******* Bihar Start *******
    public function mailBihar()
    {
      $mem_id = request('mem_id');
      $application_no = request('application_no');
      $mem_nm = request('mem_nm');
      $post_applied_for = request('post_applied_for');
      $mem_email = request('mem_email');

          $query  = BrApplicant::query();
          $all_applicant = '';
          if($application_no != '')
          {
            $query = $query->where('application_no', 'like', '%' . $application_no . '%');
          }
          if($mem_nm != '')
          {
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
          }
          if($mem_nm != '')
          {
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
          }
          if($post_applied_for != '')
          {
            $query = $query->where('post_applied_for', 'like', '%' . $post_applied_for . '%');
          }
          if($mem_id != '')
          {
            $query = $query->where('mem_id', 'like', '%' . $mem_id . '%');
          }
          $brappli= $query->paginate(100);
          $brappli->appends([
            'application_no' =>$application_no,
            'mem_nm' =>$mem_nm,
            'post_applied_for' =>$post_applied_for,
            'mem_id' => $mem_id,
            'mem_email' => $mem_email,
          ]);
     
      return view ('admin.mail.BrNewApplicantSeView',compact('brappli','mem_id'));
    }

    public function mailSend($mem_id)
    {
       
    $to_mail = DB::table('fcpm_mast_bihar')->where('mem_id',$mem_id)->select('mem_email','mem_nm','application_no','add_city','add_postofc','add_ps','add_dist','mail_count')->first();
    BrApplicant::where('mem_id', $mem_id)
                    ->update([
                    'mail_count'=> DB::raw('mail_count+1'), 
                ]);
   
    $send_email_from = DB::table('send_email_from')->value('send_email_from');
    $data = [
      'mem_id'  => $mem_id,
      'from_email' => $send_email_from,
      'subject' => 'E Verification',
      'mem_nm'=>$to_mail->mem_nm,
      'application_no'=>$to_mail->application_no,
      'add_city'=>$to_mail->add_city,
      'add_postofc'=>$to_mail->add_postofc,
      'add_ps'=>$to_mail->add_ps,
      'add_dist'=>$to_mail->add_dist,
      'mem_email'=>$to_mail->mem_email
    ];
    // Mail::to('kbskdmt.hr@gmail.com')->send(new BiharMail ($data));
    Mail::to($to_mail->mem_email)->cc(['kbskdmt.hr@gmail.com'])->send(new BiharMail($data));

    // return back()->withInput()->with('msg','Mail Send Successfully');
    return redirect()->route('add.mail')->with('msg','Mail Send Successfully');
    
    }

    public function previewPrintBr($mem_id)
    {
      $mail_preview = DB::table('fcpm_mast_bihar')->where('mem_id',$mem_id)->first();
      return view('admin.mail.preview',compact('mail_preview'));
    }

    public function generateBrPDF()
    {
      $mem_id = request('mem_id');
      $mail_down = DB::table('fcpm_mast_bihar')->where('mem_id',$mem_id)->first();
    //   dd($mail_down);
       $pdf = PDF::loadView('admin.mail.mailsend.pdfmailbodyBr',compact('mail_down'));    
        // return $pdf->download('E-Verification.pdf');
         return $pdf->stream('E-Verification.pdf');
    }

    public function brExcel()
    {
        return Excel::download(new brExport, 'members.xlsx');
    }
    // ####### Bihar End #########

    // ******* Jharkhand Start *******

    public function mailJh()
    {
      $mem_id = request('mem_id');
      $application_no = request('application_no');
      $mem_nm = request('mem_nm');
      $post_applied_for = request('post_applied_for');
      $mem_email = request('mem_email');

          $query  = JhApplicant::query();
          $all_applicant = '';
          if($application_no != '')
          {
            $query = $query->where('application_no', 'like', '%' . $application_no . '%');
          }
          if($mem_nm != '')
          {
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
          }
          if($mem_nm != '')
          {
            $query = $query->where('mem_nm', 'like', '%' . $mem_nm . '%');
          }
          if($post_applied_for != '')
          {
            $query = $query->where('post_applied_for', 'like', '%' . $post_applied_for . '%');
          }
          if($mem_id != '')
          {
            $query = $query->where('mem_id', 'like', '%' . $mem_id . '%');
          }
          $jhappli= $query->paginate(100);
          $jhappli->appends([
            'application_no' =>$application_no,
            'mem_nm' =>$mem_nm,
            'post_applied_for' =>$post_applied_for,
            'mem_id' => $mem_id,
            'mem_email' => $mem_email,
          ]);
      return view ('admin.mail.JhrNewApplicantSeView',compact('jhappli'));
    }

    public function mailSendJh($mem_id)
    {
    $to_mail = DB::table('fcpm_mast_jharkhand')->where('mem_id',$mem_id)->select('mem_email','mem_nm','application_no','add_city','add_postofc','add_ps','add_dist','mail_count')->first();
    // dd($to_mail->mail_count);
    JhApplicant::where('mem_id', $mem_id)
                    ->update([
                    'mail_count'=> DB::raw('mail_count+1'), 
                ]);
    $send_email_from = DB::table('send_email_from')->value('send_email_from');
    
    $data = [
     'mem_id' => $mem_id,
      'from_email' => $send_email_from,
      'subject' => 'E Verification',
     'mem_nm'=>$to_mail->mem_nm,
     'application_no'=>$to_mail->application_no,
     'add_city'=>$to_mail->add_city,
     'add_postofc'=>$to_mail->add_postofc,
     'add_ps'=>$to_mail->add_ps,
     'add_dist'=>$to_mail->add_dist,
     'mem_email'=>$to_mail->mem_email
    ];
    //send to email
    // Mail::to('kbskdmt.hr@gmail.com')->send(new JharkhandMail($data));
    Mail::to($to_mail->mem_email)->cc(['kbskdmt.hr@gmail.com'])->send(new JharkhandMail($data));
    // return back()->withInput()->with('msg','Mail Send Successfully');
    return redirect()->route('add.mailJh')->with('msg','Mail Send Successfully');

    }

    public function previewPrintJk($mem_id)
    {
      $mail_preview = DB::table('fcpm_mast_jharkhand')->where('mem_id',$mem_id)->first();
      // dd( $mail_preview);
      return view('admin.mail.preview',compact('mail_preview'));
    }

    public function generateJkPDF()
    {
      $mem_id = request('mem_id');
      $mail_down = DB::table('fcpm_mast_jharkhand')->where('mem_id',$mem_id)->first();
      // dd($mail_down);
       $pdf = PDF::loadView('admin.mail.mailsend.pdfmailbodyJk',compact('mail_down'));    
        return $pdf->stream('E-Verification.pdf');
    }

    public function jkExcel()
    {
        return Excel::download(new brExport, 'members.xlsx');
    }
}
