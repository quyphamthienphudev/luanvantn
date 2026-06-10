<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $table = 'leave_requests';

    protected $fillable = [
        'users_id',
        'start_date', 
        'end_date', 
        'reason', 
        'status'
    ];

    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}