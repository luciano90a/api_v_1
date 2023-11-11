<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            //reglas de validaciones
            'name'=>['required','min:5'],
            'email'=>['required','email'],
            'password'=>['required']
        ];
    }
    public function messages(){
        return [
            'name.required'=>['campo de nombre requerido'],
            'email.required'=>['campo de email requerido'],
            'password'=>['campo de pass requerido alv'],
        ];
    }
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException( response()->json([
            'error'=> $validator->errors()->all(),
        ],422) );
    }
}
