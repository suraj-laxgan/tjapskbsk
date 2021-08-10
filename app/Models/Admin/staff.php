<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    use HasFactory;
    protected $table = 'staff_mast';
    public $timestamps = false;
    protected $guarded = [
        'staff_id','f_nm','m_nm','l_nm','staff_add','staff_e_mail','staff_mob_1','staff_land_no'
    ];
    protected $fillable = [
        'staff_id','f_nm','l_nm','staff_add','staff_e_mail','staff_mob_1','staff_land_no'
    ];
}
