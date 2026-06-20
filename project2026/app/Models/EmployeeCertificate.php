<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeCertificate extends Model
{
    protected $table = 'employee_certificates';

    protected $fillable = [
        'employee_id',
        'certificate_name',
        'certificate_file',
        'issue_date',
        'expiry_date'
    ];

    public $timestamps = false;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
