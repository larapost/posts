<?php

namespace Larapost;

use Larapost\Models\Post;

class Posts
{

    private $query;

    public function __construct()
    {
        $this->query = Post::query();
    }

    public function where($where)
    {
        $this->where = $this->query->where($where);
        return $this;
    }

    public function post($id)
    {
        return Post::find($id);
    }

    public function all()
    {
        if (isset($this->where)) {
            return $this->where->get();
        }
        return Post::get();
    }

    public function create($data)
    {
        $query = Post::create($data);
        return $query;
    }

    public function update($data)
    {
        return $this->where->update($data);
    }

    public function delete()
    {
        return $this->where->delete();
    }

    public function statistics()
    {
        return Post::select([
            \DB::raw('COUNT(*) AS countAll'),
            \DB::raw('CONVERT(SUM(CASE WHEN ' . env('DB_PREFIX') . 'larapost_posts.status = "publish" THEN 1 ELSE 0 END), SIGNED INTEGER) AS publish'),
            \DB::raw('CONVERT(SUM(CASE WHEN ' . env('DB_PREFIX') . 'larapost_posts.status = "draft" THEN 1 ELSE 0 END), SIGNED INTEGER)  AS draft'),
            \DB::raw('CONVERT(SUM(CASE WHEN ' . env('DB_PREFIX') . 'larapost_posts.status = "delete" THEN 1 ELSE 0 END), SIGNED INTEGER)  AS remove'),
        ])->first();
    }
}