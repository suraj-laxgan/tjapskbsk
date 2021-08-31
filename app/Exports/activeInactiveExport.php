<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Admin\wbApplicant;
use Maatwebsite\Excel\Concerns\WithHeadings;

class activeInactiveExport implements FromCollection,WithHeadings
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
        $memo_no = request('memo_no_1');
        $mem_nm = request('mem_nm_1');
        $media_nm = request('media_nm_1');
        $mem_stat = request('mem_stat_1');
// dd(  $mem_nm );
        // $query = DB::table('fcpm_mast');
         $query  = wbApplicant::whereIn('mem_stat',['A','D']);
            // ->get();
            if($memo_no != '')
            {
                $query = $query->where('memo_no', 'like', '%'.$memo_no.'%');
            }
           
            if($mem_nm != '')
            {
               
                $query = $query->where('mem_nm', 'like', '%'.$mem_nm.'%');
                
            }
            
            if($media_nm != '')
            {
                $query = $query->where('media_nm', 'like', '%'.$media_nm.'%');
            }
            if($mem_stat != '')
            {
                $query = $query->where('mem_stat', $mem_stat);
            }
            $query = $query->select('state_code','state_nm','mem_nm','media_nm','entry_dt','contact_no','mem_email','guard_nm','gender','mem_cast','birth_dt','mem_quali','guard_relatiion','mem_add','mem_aadhar_no','mem_pan_no','mem_voterid_no','bank_acount_no','mem_bank_nm','bnk_ifsc_code','des_type','profile_pic','mem_posting_place','mem_desig','memo_no','mem_id');
            $query = $query->get();
            return $query;
    }
}
