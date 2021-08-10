<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    use HasFactory;

    protected $table = 'district_mast';

    public $timestamps = false;

    protected $guarded = [
        'district_id','district_nm'
    ];
    protected $fillable = [
        'district_id','district_nm'
    ];
}
