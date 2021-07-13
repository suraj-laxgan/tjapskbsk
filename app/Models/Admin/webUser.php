<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class webUser extends Model
{
    use HasFactory;
    protected $table = 'fcpm_mast_web';
    public $timestamps = false;
}
