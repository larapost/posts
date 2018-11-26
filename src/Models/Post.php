<?php

namespace Larapost\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'larapost_posts';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_author',
        'title',
        'content',
        'excerpt',
        'type',
        'status',
        'published_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
