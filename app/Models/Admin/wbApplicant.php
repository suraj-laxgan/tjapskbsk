<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wbApplicant extends Model
{
    use HasFactory;
    protected $table = 'fcpm_mast';

    public $timestamps = false;
    
    protected $guarded = [
        'state_nm','mem_nm','media_nm','entry_dt','contact_no','mem_email'
    ];

    protected $primaryKey = 'mem_id';

    protected $fillable = [
        'mem_id','memo_no','new_id', 'state_nm','state_code','mem_nm','media_nm','entry_dt','contact_no','mem_email','guard_relatiion','guard_nm','gender','mem_cast','birth_dt','mem_quali','mem_add','mem_aadhar_no','mem_pan_no','mem_voterid_no','bank_acount_no','mem_bank_nm','bnk_ifsc_code','des_type','mem_desig','district','mem_posting_place','sl_no','export_stat'
    ];
}
