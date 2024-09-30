<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterStudentInCourseRequest extends FormRequest
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
            throw new \Exception('UnAuthorized',422);
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
            'courses_id'=>'required|array|exists:courses,id'
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new HttpResponseException(
            response()->json([
                'status'=>'failed',
                'message'=>'failed validation please confirm the input',
                'errors'=>$validator->errors()
            ],403)
        );
    }
    public function attributes(){
        return [
            'course_id'=>'Course ID'
        ];
    }
    public function messages(){
        return [
            'required'=>'Error : The :attribute field is required',
            'array'=>'Error : The :attribute field must be an array',
            'exists'=>'Error : The :attribute field value does not exists in table courses'
        ];
    }
}
