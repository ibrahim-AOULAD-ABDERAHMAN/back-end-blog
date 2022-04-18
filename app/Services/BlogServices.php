<?php

namespace App\Services;

use App\Helpers\Helper;

class BlogServices
{
    public function filterBlogs($query, $filter)
    {
        $pagination = Helper::pagination;

        if(isset($filter['pagination']) && $filter['pagination'] > 0 ){
            $pagination = $filter['pagination'];
        }

        if(isset($filter['title']) && $filter['title'] != "" ){
            $query = $query->search($filter['title']);
        }

        return $query->with('sections:id,title,body')->paginate($pagination);
    }
}
?>
