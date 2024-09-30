<?php

namespace App\Http\Requests\admin;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class CreateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
            $user = JWTAuth::parseToken()->authenticate();
            if($user && $user->role === 'admin'){
                return true;
            }else{
                throw new Exception('UnAuthorized',403);
            }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|max:100',
            'email'=>'required|email|unique:students,email',
            'password'=>'required|string|min:8|max:50',
            'role'=>'nullable|in:student'
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new HttpResponseException(
            response()->json([
                'status'=>'failed',
                'message'=>'failed validation please confirm the input',
                'errors'=>$validator->errors()
            ],422)
        );
    }
    public function attributes(){
        return [
            'name'=>'student name',
            'email'=>'student email',
            'password'=>'studnet password',
            'role'=>'student role'
        ];
    }
    public function messages(){
        return [
            'required'=>'The :attribute field is required',
            'email'=>'Please input a valid email',
            'string'=>'The :attribute field value must be a string',
            'unique'=>'The :attribute field must be a unique',
            'min'=>'The :attribute min character is :min',
            'max'=>'The :attribute max character is :max',
            'in'=>'The value of role must only in student '
        ];
    }
}
