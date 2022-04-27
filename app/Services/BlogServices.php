<?php

namespace App\Services;

use App\Helpers\Helper;

class BlogServices
{
    public function filterBlogs($query, $filter)
    {
        $count_per_page = Helper::count_per_page;

        if(isset($filter['count_per_page']) && $filter['count_per_page'] > 0 ){
            $count_per_page = $filter['count_per_page'];
        }

        if(isset($filter['title']) && $filter['title'] != "" ){
            $query = $query->search($filter['title']);
        }
        // return $query->with('sections')->orderBy('created_at', 'DESC')->paginate($pagination);
        return $query->orderBy('created_at', 'DESC')->paginate($count_per_page);
    }
}
?>
