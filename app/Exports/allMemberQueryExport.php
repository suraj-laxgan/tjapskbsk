<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Admin\wbApplicant;


class allMemberQueryExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $mem_id = request('mem_id');
        $mem_stat = request('mem_stat');
        $memo_no = request('memo_no');
    //    dd($memo_no);

        $query =  wbApplicant::where('mem_stat','A')->where('reg_status','!=','new')
        ->select('mem_id','memo_no','profile_pic','mem_desig','birth_dt','mem_posting_place','mem_nm','media_nm');
        // dd( $query);
      
        $all_memid = '';
  
            if($mem_id != '')
            {
            $query = $query->where('mem_id', 'like', '%' . $mem_id . '%');
            }

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
            $query = $query->select('state_code','state_nm','mem_nm','media_nm','entry_dt','contact_no','mem_email','guard_nm','gender','mem_cast','birth_dt','mem_quali','guard_relatiion','mem_add','mem_aadhar_no','mem_pan_no','mem_voterid_no','bank_acount_no','mem_bank_nm','bnk_ifsc_code','des_type','profile_pic','mem_posting_place','mem_desig','memo_no','mem_id');
            $query = $query->get();
            return $query;
    }
}
