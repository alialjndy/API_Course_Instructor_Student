<?php

namespace App\Http\Requests\admin\instructor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CreateInstructorRequest extends FormRequest
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
            throw new \Exception('UnAuthorized',403);
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
        'name'=>'required|string|min:3|max:100|unique:instructors,name',
        'experience'=>'required|numeric|min:1|max:50',
        'speciality'=>'required|string|max:255'
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
            'name'=>'instructor name',
            'experience'=>'number years of experience',
            'speciality'=>'instructor speciality'
        ];
    }
    public function messages(){
        return [
            'required'=>'The :attribute field is required',
            'string'=>'The :attribute field value must be a string',
            'unique'=>'The :attribute field must be a unique value',
            'min'=>'The :attribute min character is :min',
            'max'=>'The :attribute max character is :max',
            'numeric'=>'The :attribute must be a numeric value'
        ];
    }
}
