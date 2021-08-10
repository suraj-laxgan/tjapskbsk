<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class printConLetter extends Model
{
    use HasFactory;
    protected $table = 'print_letter_mast';
    public $timestamps = false;
    protected $guarded = [  'print_id',
    'memo_id',
    'user_id',
    'ip_add',
    'print_dt',
    'print_time'
];
    protected $fillable = [
        'print_id',
        'memo_id',
        'user_id',
        'ip_add',
        'print_dt',
        'print_time',
        
    ];
}
