<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Admin\wbApplicant;

class confirmationLetter implements FromCollection,WithHeadings
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
        $mem_id = request('mem_id');
        $memo_no = request('memo_no');
        $memo_id = request('memo_id');
        

        $query  = wbApplicant::where('mem_stat','A')->where('export_stat','Y');

          if($memo_no != '')
          {
            $query = $query->where('memo_no', 'like', '%' . $memo_no . '%');
          }

          if($mem_id != '')
          {
            $query = $query->where('mem_id', 'like', '%' . $mem_id . '%');
          }
          
          if($memo_id != '')
          {
          $query = $query->where('memo_id', 'like', '%' . $memo_id . '%');
          }

        $query = $query->select('state_code','state_nm','mem_nm','media_nm','entry_dt','contact_no','mem_email','guard_nm','gender','mem_cast','birth_dt','mem_quali','guard_relatiion','mem_add','mem_aadhar_no','mem_pan_no','mem_voterid_no','bank_acount_no','mem_bank_nm','bnk_ifsc_code','des_type','profile_pic','mem_posting_place','mem_desig','memo_no','mem_id');
        $query = $query->get();
        return $query;
    }
}

