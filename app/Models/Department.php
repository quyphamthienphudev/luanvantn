<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name','description'];

    public $timestamps = false;
    
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}