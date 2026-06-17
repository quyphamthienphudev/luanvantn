<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardDiscipline extends Model
{
    protected $table = 'reward_discipline';

    protected $fillable = [
        'employee_id',
        'type',
        'title',
        'amount',
        'decision_date'
    ];

    public $timestamps = false;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}