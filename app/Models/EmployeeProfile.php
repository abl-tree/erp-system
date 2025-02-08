<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    protected $fillable = [
        'user_id',
        'department_id',
        'employment_type_id',
        'attendance_shift_id',
        'hired_at',
        'job_position',
        'special_notes'
    ];  
}
