<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model 
{
    protected $table = 'employees';
    
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
        'street',
        'ward',
        'province',
        'hire_date',
        'status',
        'users_id'
    ];

    public $timestamps = false;

    public function user() 
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function certificates()
    {
        return $this->hasMany(EmployeeCertificate::class);
    }

    //them sau
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
