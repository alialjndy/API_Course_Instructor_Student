<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Service\Student\StudentService;
use Illuminate\Support\Facades\Response;

class StudentController extends Controller
{
    protected $studentService ;
    public function __construct(StudentService $studentService){
        $this->studentService = $studentService ;
    }
    public function index()
    {
        $allCourses = Course::select('id','title','description','start_date')->with(['instructors'=>function ($query){
            $query->select('instructors.id','instructors.name','instructors.experience','instructors.speciality');
        }])
        ->get();
        return Response::api('success','all courses',$allCourses,200);
    }
    public function show(string $student_id)
    {
        $student = $this->studentService->showCourseByID($student_id);
        return Response::api('success','student info',$student,200);
    }
}
