<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model 
{
    
    protected $fillable = [
        'department_id',
        'position_id',
        'employee_code',
        'full_name',
        'gender',
        'date_of_birth',
        'phone',
        'email',
        'address',
        'hire_date',
        'status'
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(\App\Models\Position::class);
    }
}
