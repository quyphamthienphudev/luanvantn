<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table = 'payrolls';
    
    protected $fillable = [
        'employee_id',
        'month',
        'year',
        'base_salary',
        'allowance',
        'bonus',
        'deduction',
        'work_numbers',
        'total_salary'
    ];
}