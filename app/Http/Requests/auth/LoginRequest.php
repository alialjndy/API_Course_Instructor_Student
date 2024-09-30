<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
            'email'=>['required','email'],
            'password'=>['required']
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new  HttpResponseException(
            response()->json([
                'status'=>'failed',
                'message'=>'Failed Verification please confirm the input',
                'errors'=>$validator->errors()
            ],422),
            );
    }
    public function attributes()
    {
        return [
            'email'=>'user email',
            'password'=>'user password'
        ];
    }
    public function messages(){
        return [
            'required'=>'Error : The :attribute field is required',
            'email'=>'Error : please enter a valid email'
        ];
    }
}
