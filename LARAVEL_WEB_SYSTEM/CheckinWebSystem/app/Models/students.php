<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use HasFactory;

    public $primaryKey = 'student_id';
    protected $fillable = [
        'student_firstname',
        'student_lastname',
        'student_email',
        'student_phone',
        'student_regNo',
        'student_password',
        'student_profile',
    ];


    public function students_unit_students_relation()
    {
        return $this->hasMany(unit_students::class, 'student_id');
    }

    public function students_attendance_relation()
    {
        return $this->hasMany(attendance_list::class, 'student_id');
    }
}
