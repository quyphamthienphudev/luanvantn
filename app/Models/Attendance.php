<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee; 

class Attendance extends Model
{
    protected $table = 'attendances';
    
    protected $fillable = [
        'employee_id', 
        'work_date', 
        'check_in', 
        'check_out', 
        'status', 
        'note'
    ];

    public function employee() 
    { 
        return $this->belongsTo(Employee::class, 'employee_id'); 
    }
}