<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest
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
            'name'=>'required|string|max:100|unique:students,name',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:8',
            'role'=>'nullable|in:student'
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new HttpResponseException(
            response()->json([
                'status'=>'failed',
                'message'=>'failed valdiation please confirm the input',
                'errors'=>$validator->errors()
            ])
            );
    }
    public function attributes(){
        return [
            'name'=>'user name',
            'email'=>'user email',
            'password'=>'user password',
            'role'=>'user role'
        ];
    }
    public function messages(){
        return [
            'required'=>'The :attribute field is required',
            'string'=>'The :attribute value must be a string',
            'max'=>'The :attribute value does not longer than :max',
            'unique'=>'The :attribute field value must be a unique',
            'min'=>'The :attribute min length is :min',
            'in'=>'The role value must be in student only'
        ];
    }
}
