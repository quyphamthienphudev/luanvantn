<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{   
    protected $table = 'departments';

    protected $fillable = ['name','description','users_id'];

    public $timestamps = false;
    
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }
}