<?php

namespace App\Http\Requests\admin\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = JWTAuth::parseToken()->authenticate();
        if($user && $user->role === 'admin'){
            return true;
        }
        return response()->json([
            'status'=>'failed',
            'message'=>'UnAuthorzied'
        ],403);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>['nullable','string','max:100','unique:courses,title'],
            'description'=>['nullable','string','max:255'],
            'start_date'=>['nullable','date'],
            'Instructor_id'=>['nullable','array','exists:instructors,id']
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
         throw new HttpResponseException(
            response()->json([
                'status'=>'failed',
                'message'=>'failed Validation please confirm the input',
                'errors'=>$validator->errors()
            ],422),
        );
    }
    public function attributes(){
        return [
            'title'=>'Course Title',
            'description'=>'Course Description',
            'start_date'=>'Course Start Date',
            'Instructor_id'=>'Instructor ID'
        ];
    }
    public function messages(){
        return [
            'string'=>'Error : The :attribute field value must be a string',
            'max'=>'Error : The :attribute field max character is :max',
            'unique'=>'Error : The :attribute field value must be a unique',
            'date'=>'Error : The :attribute field value must be a date',
            'array'=>'Error : The :attribute field must be an array',
            'exists'=>'Error : The :attribute field value is invalid '
        ];
    }
}
