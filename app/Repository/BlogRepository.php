<?php

namespace App\Repository;

use App\Helpers\Helper;
use App\Models\Blog;
use App\Services\BlogServices;

class BlogRepository {

    protected $blog;
    protected $blogServices;

    public function __construct(Blog $blog, BlogServices $blogServices)
    {
        $this->blog = $blog;
        $this->blogServices = $blogServices;
    }

    public function getAll($filter)
    {
        return $this->blogServices->filterBlogs($this->blog, $filter);
    }

    public function getById($id)
    {
        return $this->blog->where('id', $id)->first();
    }

    public function create($data)
    {
        $new_blog = new $this->blog;
        $new_blog->title       = $data['title'];
        $new_blog->body        = $data['body'];
        $new_blog->image       = Helper::saveFile($data['image'], 'blogs');
        $new_blog->id_category = $data['id_category'];
        $new_blog->save();

        return $new_blog;
    }

    public function update($id, $data)
    {
        $update_blog = $this->blog->where('id', $id)->first();
        $update_blog->title       = $data['title'];
        $update_blog->body        = $data['body'];
        $update_blog->image       = Helper::saveFile($data['image'], 'blogs');
        $update_blog->id_category = $data['id_category'];
        $update_blog->update();

        return $update_blog;
    }

    public function delete($id)
    {
        $delete_blog = $this->blog->where('id', $id)->first();
        $delete_blog->delete();

        return $delete_blog;
    }

}
?>
