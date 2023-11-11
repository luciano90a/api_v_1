<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'post_title'=>['required'],
            'post_description'=>['required'],
            'post_image_dir'=>['required'],
            'post_likes'=>['required'],
            'post_comments'=>['required'],
        ];
    }
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException( response()->json([
            'error'=> $validator->errors(),
        ],422) );
    }
}
