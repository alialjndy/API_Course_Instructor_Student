<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Course\CreateCourseRequest;
use App\Http\Requests\admin\Course\UpdateCourseRequest;
use App\Models\Course;
use App\Service\Admin\CourseService;
use Illuminate\Support\Facades\Response;

class CourseController extends Controller
{
    protected $courseService;
    public function __construct(CourseService $courseService){
        $this->courseService = $courseService ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCourses = Course::select('id','title','description','start_date')->with(['instructors'=>function ($query){
            $query->select('instructors.id','instructors.name','instructors.experience','instructors.speciality');
        }])
        ->get();
        return Response::api('success','all courses',$allCourses,200);
    }

    /**
     * Summary of store
     * @param \App\Http\Requests\admin\Course\CreateCourseRequest $request
     * @return mixed
     */
    public function store(CreateCourseRequest $request)
    {
        $validatedData = $request->validated();
        $course = $this->courseService->createCourse($validatedData);
        $InstructorInCourse = $course->instructors()->select('instructors.name','instructors.experience','instructors.speciality')
        ->get()
        ->makeHidden('pivot');
        return Response::api('success','course created successfully',[
            'course info'=>$course,
            'teacher Info'=>$InstructorInCourse
        ],201);
    }

    /**
     * Summary of show
     * @param string $course_id
     * @return mixed
     */
    public function show(string $course_id)
    {
        $course = $this->courseService->showCourseByID($course_id);
        return Response::api('success','course info',$course,200);

    }

    /**
     * Summary of update
     * @param \App\Http\Requests\admin\Course\UpdateCourseRequest $request
     * @param string $course_id
     * @return mixed
     */
    public function update(UpdateCourseRequest $request, string $course_id)
    {
        $validatedData = $request->validated();
        $this->courseService->updateCourse($validatedData,$course_id);
        return Response::api('success','course updated successfully',true,200);
    }

    /**
     * Summary of destroy
     * @param string $course_id
     * @return mixed
     */
    public function destroy(string $course_id)
    {
        $this->courseService->deleteCourse($course_id);
        return Response::api('success','course deleted successfully',null,200);
    }
}
