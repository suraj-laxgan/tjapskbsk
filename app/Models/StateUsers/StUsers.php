<?php

namespace App\Models\StateUsers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class StUsers extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $table = 'state_users_mast';

    protected $fillable = [
        'ur_id','state_nm','state_code', 'user_id','email','password','plain_password','user_group'
    ];
}
