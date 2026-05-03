<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $table = 'leave_requests';

    protected $fillable = [
        'employee_id',
        'start_date', 
        'end_date', 
        'reason', 
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'employee_id');
    }
}