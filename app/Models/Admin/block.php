<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class block extends Model
{
    use HasFactory;
    protected $table = 'block_mast';

    public $timestamps = false;

    protected $guarded = [
        'block_id','block_nm','district_nm'
    ];
    protected $fillable = [
        'block_id','block_nm','district_nm'
    ];
}
