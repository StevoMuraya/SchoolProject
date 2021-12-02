<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit_students extends Model
{
    use HasFactory;


    public function unit_students_students_relation()
    {
        return $this->belongsTo(students::class, 'student_id');
    }
    public function unit_students_class_relation()
    {
        return $this->belongsTo(classes::class, 'class_id');
    }
}
