<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classes_held extends Model
{
    use HasFactory;
    protected $table = 'classes_held';

    public function classes_held_classes_relation()
    {
        return $this->belongsTo(classes::class, 'class_id');
    }


    public function class_held_attendance_relation()
    {
        return $this->hasMany(attendance_list::class, 'class_code', 'class_code');
        // ->orderBy('student_id', 'desc');;
    }
}
