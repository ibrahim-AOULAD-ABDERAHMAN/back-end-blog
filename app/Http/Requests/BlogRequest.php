<?php

namespace App\Http\Requests;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class BlogRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Helper::isAdmin()) return true;

        return match (Route::currentRouteName()) {
            'blogs-index', 'blogs-show'  => true,
            'blogs-delete'  => Gate::authorize('delete-blog'),
            'blogs-store'   => Gate::authorize('store-blog'),
            'blogs-update'  => Gate::authorize('update-blog'),
            default => false,
        };

    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id')
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return match (Route::currentRouteName()) {
            'blogs-index'   =>$this->filterDta(),
            'blogs-show', 'blogs-delete' => ['id' => 'exists:blogs,id'],
            'blogs-store'   => $this->storeOrUpdate(),
            'blogs-update'  => ['id' => 'exists:blogs,id'] + $this->storeOrUpdate(),
            default => [],
        };
    }

    public function storeOrUpdate()
    {
        return [
            'title'                     => ['bail', 'required', 'max:100'],
            'body'                      => ['bail', 'required', 'max:60000'],
            'image'                     => ['bail', 'nullable', 'mimes:jpg,jpeg,png'],
            'sections'                  => ['bail', 'nullable', 'array'],
            'sections.*.section_title'  => ['bail' ,'nullable', 'max:100'],
            'sections.*.section_body'   => ['bail' ,'nullable', 'max:60000'],
        ];
    }

    public function filterDta()
    {
        return [
            'title' => 'nullable',
            'pagination' => 'nullable'
        ];
    }
}
