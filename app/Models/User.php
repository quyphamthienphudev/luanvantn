<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'role_id'
    ];
    protected $hidden = ['password'];
    public $timestamps = false;
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}