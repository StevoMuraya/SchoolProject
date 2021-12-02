<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance_list extends Model
{
    use HasFactory;
    protected $table = 'attendance_list';
    public $primaryKey = 'attendance_id';


    public function attendance_classes_held_relation()
    {
        return $this->belongsTo(classes_held::class, 'class_code', 'class_code');
    }

    public function attendance_classes_relation()
    {
        return $this->belongsTo(classes::class, 'class_id');
    }

    public function attendance_students_relation()
    {
        return $this->belongsTo(students::class, 'student_id');
    }
}
