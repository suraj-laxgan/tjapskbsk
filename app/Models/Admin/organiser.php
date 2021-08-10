<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class organiser extends Model
{
    use HasFactory;
    
    protected $table = 'organiser_mast';
    public $timestamps = false;
    protected $guarded = [
        'organiser_id','organiser_nm'
    ];
    protected $fillable = [
        'organiser_id','organiser_nm'
    ];

}
