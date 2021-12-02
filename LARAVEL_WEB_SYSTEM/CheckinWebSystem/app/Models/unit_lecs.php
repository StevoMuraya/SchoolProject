<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit_lecs extends Model
{
    use HasFactory;

    protected $fillable = [
        'lec_id',
        'unit_id',
        'assigned_by',
    ];


    public function unit_lectuer_relation()
    {
        return $this->belongsTo(Lecturers::class, 'lec_id');
    }

    public function unit_units_relation()
    {
        return $this->belongsTo(Units::class, 'unit_id');
    }
}
