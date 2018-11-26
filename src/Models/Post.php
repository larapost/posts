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

    protected $with = [
        'cats_main',
        'cats_sub'
    ];

    public function cats_main()
    {
        return $this->hasMany('Larapost\Models\PostsCat')->where('type', '=', 'main');
    }

    public function cats_sub()
    {
        return $this->hasMany('Larapost\Models\PostsCat')->where('type', '=', 'sub');
    }

}
