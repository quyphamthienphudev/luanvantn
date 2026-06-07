<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model 
{
    protected $table = 'candidates';
    
    protected $fillable = [
        'candidate_id',
        'full_name',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'phone',
        'education',
        'email',
        'address',
        'street',
        'ward',
        'province',
        'users_id'
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }
}
