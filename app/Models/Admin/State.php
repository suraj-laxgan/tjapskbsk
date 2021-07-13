<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'state_mast';

   
    protected $guarded = [
        'state_code','state_nm','head_off_nm','contact_no','Banner_one','Banner_two','Banner_three'
    ];

}
