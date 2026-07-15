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
        'identify',
        'national',
        'birthplace',
        'issue_date',
        'ethnic_group',
        'phone',
        'email',
        'address',
        'street',
        'ward',
        'province',
        'hire_date',
        'status'
    ];

    public $timestamps = false;

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

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function rewardDisciplines()
    {
        return $this->hasMany(RewardDiscipline::class,'employee_id');
    }
}
