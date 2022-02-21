<?php

namespace App\Models\tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDesignation extends Model
{
    use HasFactory;
    protected $table = 'staff_designations';

    protected $fillable = [
        'name'
    ];
}
