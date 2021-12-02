<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturers extends Model
{
    use HasFactory;

    public $primaryKey = 'lec_id';
    protected $fillable = [
        'lec_firstname',
        'lec_lastname',
        'lec_email',
        'lec_phone',
        'lec_code',
        'lec_image',
        'lec_password',
        'date_reg',
        'reg_by',
        'department',
    ];


    public function lecturer_unit_relation()
    {
        return $this->hasMany(unit_lecs::class, 'lec_id');
    }


    public function lecturer_classes_relation()
    {
        return $this->hasMany(classes::class, 'unit_id');
    }
}
