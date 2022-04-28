<?php

namespace App\Repository;

use App\Helpers\Helper;
use App\Models\Blog;
use App\Models\Section;
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
        return $this->blog->where('id', $id)->with('sections')->first();
    }

    public function create($data)
    {
        $new_blog = new $this->blog;
        $new_blog->title       = $data['title'];
        $new_blog->body        = $data['body'];
        if(isset($data['image'])){
        $new_blog->image       = Helper::saveFile($data['image'], 'blogs');
        }
        $new_blog->save();
       
        if( isset($data['sections'])  and count($data['sections']) > 0 ){
            foreach($data['sections'] as $key => $setion){
                $new_section = new Section();
                $new_section->section_title   = $setion['section_title'];
                $new_section->section_body    = $setion['section_body'];
                $new_section->id_blog         = $new_blog->id;
                $new_section->save();
            }
        }

        return $new_blog;
    }

    public function update($id, $data)
    {
        $update_blog = $this->blog->where('id', $id)->first();
        $update_blog->title       = $data['title'];
        $update_blog->body        = $data['body'];
        if(isset($data['image'])){
            $update_blog->image       = Helper::saveFile($data['image'], 'blogs');
        }
        $update_blog->update();

        $update_blog->sections()->delete();
        if( isset($data['sections'])  and count($data['sections']) > 0 ){
            foreach($data['sections'] as $key => $setion){
                $new_section = new Section();
                $new_section->section_title   = $setion['section_title'];
                $new_section->section_body    = $setion['section_body'];
                $new_section->id_blog         = $update_blog->id;
                $new_section->save();
            }
        }

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
