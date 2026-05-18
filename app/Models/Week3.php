<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Week3 extends Model
{
    protected $table = 'users_tuan03';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone'
    ];
}
