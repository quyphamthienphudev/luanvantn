<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'positions';

    protected $fillable = ['name', 'base_salary'];

    public $timestamps = false;
    
    public function employees() { 
        return $this->hasMany(Employee::class, 'position_id'); 
    }
    
}
