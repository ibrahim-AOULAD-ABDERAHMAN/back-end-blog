<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends BaseRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       return [
                'email'     => ['bail', 'required', 'string', 'max:50'],
                'password'  => ['bail', 'required', 'string', 'min:6', 'max:50'],
       ];
    }
}
