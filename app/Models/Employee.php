<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table = 'employees';

    protected $guarded = ['id'];

    protected $case = [
        'dob' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
