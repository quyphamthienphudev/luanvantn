<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';

    protected $fillable = [
        'employee_id',
        'contract_code',
        'contract_type',
        'start_date',
        'end_date',
        'salary',
        'description',
        'contract_file',
        'status',
        'users_id'
    ];

    public $timestamps = false;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
