<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
        return true;
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
            'blogs-index'   => $this->filter(),
            'blogs-show', 'blogs-delete' => ['id' => 'exists:blogs,id'],
            'blogs-store'   => $this->storeOrUpdate(),
            'blogs-update'  => ['id' => 'exists:blogs,id'] + $this->storeOrUpdate(),
            default => [],
        };
    }

    public function storeOrUpdate()
    {
        return [
            'title'         => ['bail', 'required', 'max:100'],
            'body'          => ['bail', 'required', 'max:60000'],
            'image'         => ['bail', 'nullable', 'mimes:jpg,jpeg,png'],
            'id_category'   => ['bail',  'required', 'exists:categories,id']
        ];
    }

    public function filter()
    {
        return [
            'title' => 'nullable',
            'id_category' => 'nullable'
        ];
    }
}