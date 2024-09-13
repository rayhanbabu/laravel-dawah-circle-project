<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'status',
        'password',
        'email_verify_status',
        'application_category',
        'registration',
        'hall_id',
        'department',
        'address',
        'phone',
        'gender',
        'member_category',
        'ip_address',
        'emailmd5',
    ];

}
