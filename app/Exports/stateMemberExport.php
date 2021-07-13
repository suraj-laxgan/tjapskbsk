<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Admin\wbApplicant;
use Auth;

class stateMemberExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return ["State Code", "State Name", "Member Name","Media Name", "Entry Date","Contact No","Email","Gurdain Name","Gender","Cast","Date of Birth","Qualification","Relation","Address","Adhar no","Pan No","Voter Id No","Bank Account No","Bank Name","Ifsc Code","Designation Type","Picture","Posting Place","Designation","Memo No"];
    }

    public function collection()
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

        $query  = wbApplicant::where('mem_stat','A')->where('state_code',$state_code);

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
        $query = $query->select('state_code','state_nm','mem_nm','media_nm','entry_dt','contact_no','mem_email','guard_nm','gender','mem_cast','birth_dt','mem_quali','guard_relatiion','mem_add','mem_aadhar_no','mem_pan_no','mem_voterid_no','bank_acount_no','mem_bank_nm','bnk_ifsc_code','des_type','profile_pic','mem_posting_place','mem_desig','memo_no','mem_id');
        $query = $query->get();
        return $query;
    }

   
}
