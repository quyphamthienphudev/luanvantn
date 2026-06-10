<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class Attendance extends Model
{
    protected $table = 'attendances';
    
    protected $fillable = [
        'users_id', 
        'work_date', 
        'check_in', 
        'check_out', 
        'status',
        'confirm'
    ];

    public $timestamps = false;

    public function user() 
    { 
        return $this->belongsTo(User::class, 'users_id'); 
    }
}