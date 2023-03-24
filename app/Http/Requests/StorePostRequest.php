<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
//            'title'=>'required|min:5|max:250|unique:posts,title',
//            'description'=>'required|min:5|max:500',
//            'feature_image'=>'nullable|mimes:jpg,png,jpeg',
//            'multiple_photos'=>'required',
//            'multiple_photos.*'=>'mimes:jpg,png,jpeg|file',
//            'category'=>'required|exists:categories,id',
        ];
    }
}
