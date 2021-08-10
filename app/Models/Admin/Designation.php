<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $table = 'desig_mast';

    public $timestamps = false;

    // protected $primaryKey = 'des_id';

    protected $guarded = [
        'des_id','des_type','sl_no','des_nm','des_no_post',
    ];
    protected $fillable = [
        'des_id','des_type','sl_no','des_nm','des_no_post'
    ];
}
