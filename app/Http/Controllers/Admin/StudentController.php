<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CreateStudentRequest;
use App\Http\Requests\admin\RegisterStudentInCourseRequest;
use App\Http\Requests\admin\UpdateStudentRequest;
use App\Models\Student;
use App\Service\Admin\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class StudentController extends Controller
{
    protected $studentService ;
    public function __construct(StudentService $studentService){
        $this->studentService = $studentService ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allStudents = Student::select('name','email')->with('courses')->get();
        return Response::api('success','all students',$allStudents,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateStudentRequest $request)
    {
        $valdiatedData = $request->validated();
        $student = $this->studentService->createStudent($valdiatedData);
        return Response::api('success','student created successfully',$student,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $student_id)
    {
        $student = $this->studentService->showStudentByID($student_id);
        return Response::api('success','student info',$student,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, string $student_id)
    {
        $validatedData = $request->validated();
        $this->studentService->updateStudent($validatedData,$student_id);
        return Response::api('success','student updated successfully',[true],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $student_id)
    {
        $this->studentService->deleteStudent($student_id);
        return Response::api('success','student deleted successfully',[null],200);
    }
    public function registerStudentInCourse(RegisterStudentInCourseRequest $request,string $student_id){
        $validatedData = $request->validated();
        $courses = $this->studentService->registerStudentInCourse($validatedData,$student_id);

        return Response::api('success','student registerd successfully',[$courses],200);

    }
}
