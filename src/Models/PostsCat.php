<?php

namespace Larapost\Models;

use Illuminate\Database\Eloquent\Model;

class PostsCat extends Model
{
    protected $table = 'larapost_post_cats';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'cat_id',
        'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
