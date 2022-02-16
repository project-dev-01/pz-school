<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends TenantModel
{
    use HasFactory;
    protected $table = 'users';
    
}
