<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    public $primaryKey = 'class_id';
    use HasFactory;

    public function classes_relation()
    {
        return $this->hasMany(classes_held::class, 'class_id');
    }

    public function classes_attendance_relation()
    {
        // return $this->hasManyThrough(
        //     attendance_list::class,
        //     classes_held::class,
        //     'class_id',
        //     'class_code',
        //     'class_id'
        // );
        return $this->hasMany(attendance_list::class, 'class_id');
    }

    public function students_unit_students_relation()
    {
        return $this->hasMany(unit_students::class, 'class_id');
    }


    public function classes_unit_relation()
    {
        return $this->belongsTo(Units::class, 'unit_id');
    }

    public function classes_lecturer_relation()
    {
        return $this->belongsTo(Lecturers::class, 'lec_id');
    }
}
