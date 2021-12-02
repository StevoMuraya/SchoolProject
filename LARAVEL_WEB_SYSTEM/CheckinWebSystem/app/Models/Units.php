<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Units extends Model
{

    public $primaryKey = 'unit_id';
    use HasFactory;

    protected $fillable = [
        'unit_code',
        'unit_name',
        'unit_department',
        'reg_by',
    ];


    public function units_unit_relation()
    {
        return $this->hasMany(unit_lecs::class, 'unit_id');
    }

    public function unit_classes_relation()
    {
        return $this->hasMany(classes::class, 'unit_id');
    }
}
