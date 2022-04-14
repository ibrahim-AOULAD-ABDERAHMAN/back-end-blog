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

        if(isset($filter['id_category']) && $filter['id_category'] > 0 ){
            $query = $query->where('id_category' , '=' , $filter['id_category']);
        }

        return $query->paginate($pagination);
    }
}
?>
