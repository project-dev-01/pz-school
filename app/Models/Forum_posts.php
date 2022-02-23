<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum_posts extends Model
{
    use HasFactory;
    protected $table = 'forum_posts';

    protected $fillable = [
        'user_id',
        'user_name',
        'branch_id',
        'token' ,
        'topic_title',
        'types' ,
        'body_content',
        'category',
        'tags',
        'imagesorvideos'        
    ];
}