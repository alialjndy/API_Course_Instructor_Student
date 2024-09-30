<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\instructor\CreateInstructorRequest;
use App\Http\Requests\admin\instructor\UpdateInstructroRequest;
use App\Models\Instructor;
use App\Service\Admin\InstuctorService;
use Illuminate\Support\Facades\Response;

class InstructorController extends Controller
{
    protected $instuctorService ;
    public function __construct(InstuctorService $instuctorService){
        $this->instuctorService = $instuctorService ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allInstructors = Instructor::select('id','name','experience','speciality')->with('courses')->get();
        return Response::api('success','all Instructors',$allInstructors,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateInstructorRequest $request)
    {
        $validatedData = $request->validated();
        $instructor = $this->instuctorService->createInstructor($validatedData);
        return Response::api('success','Instructor created successfully',$instructor,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $Instructor_id)
    {
        $instructor = $this->instuctorService->showInstructorByID($Instructor_id);
        return Response::api('success','Instructor info',$instructor,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructroRequest $request, string $instructor_id)
    {
        $validatedData = $request->validated();
        $this->instuctorService->updateInstructor($validatedData,$instructor_id);
        return Response::api('success','Instructor updated successfully',true,200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $instructor_id)
    {
        $this->instuctorService->deleteInstructor($instructor_id);
        return Response::api('success','Instructor deleted successfully',null,200);
    }
    /**
     * Summary of showCourseRelatedWithInstructor
     * @param string $instructor_id
     * @return mixed
     */
    public function showCourseRelatedWithInstructor(string $instructor_id){
        $user = Instructor::findOrFail($instructor_id);
        $info = $this->instuctorService->courseRelatedWithIns($instructor_id);
        return Response::api('success','All courses Related with '.$user->name, $info,200);
    }
    /**
     * Summary of showStudentRelatedWithInstructor
     * @param string $instructor_id
     * @return mixed
     */
    public function showStudentRelatedWithInstructor(string $instructor_id){
        $user = Instructor::findOrFail($instructor_id);
        $info = $this->instuctorService->studentRelatedWithIns($instructor_id);
        return Response::api('success','All student Related With '.$user->name,$info,200);
    }
}
