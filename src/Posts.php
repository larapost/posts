<?php

namespace Larapost;

use Larapost\Models\Post;
use Larapost\Models\PostsCat;

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

    public function addCat($post_id, $cat_id, $type = 'main')
    {
        $cat = PostsCat::where('post_id', '=', $post_id)
        ->where('cat_id', '=', $cat_id)
        ->where('type', '=', $type)
        ->first();
        if ($cat) {
            return false;
        }
        PostsCat::create([
            'post_id' => $post_id,
            'cat_id' => $cat_id,
            'type' => $type,
        ]);
        return true;
    }

    public function removeCat($post_id, $cat_id, $type = 'main')
    {
        $cat = PostsCat::where('post_id', '=', $post_id)
        ->where('cat_id', '=', $cat_id)
        ->where('type', '=', $type);
        if (!$cat->first()) {
            return false;
        }
        $cat->delete();
        return true;
    }

    public function clearCat($post_id, $type = 'main')
    {
        $cat = PostsCat::where('post_id', '=', $post_id)
        ->where('type', '=', $type);
        if (!$cat->first()) {
            return false;
        }
        $cat->delete();
        return true;
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