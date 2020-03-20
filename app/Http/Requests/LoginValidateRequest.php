<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostValidateRequest extends FormRequest
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
        $rule= [
            'subject' => ['required', 'max:255'],
            'content' => ['required', 'max:255'],
        ];
        if (request()->has('name')) {
            $rule['name'] = ['required', 'l'];
        }
        return [
            'name' => [
                'required'
            ]
        ];
    }
}
