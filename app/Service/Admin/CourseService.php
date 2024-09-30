<?php
namespace App\Service\Admin;

use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\Log;

class CourseService{
    /**
     * Summary of createCourse
     * @param array $data
     * @throws \Exception
     * @return
     */
    public function createCourse(array $data){
        try{
            $course = Course::create($data);
            $course->Instructors()->attach($data['Instructor_id']);
            return $course ;
        }catch(Exception $e){
            Log::error('Error when create course '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * Summary of showCourseByID
     * @param string $course_id
     * @throws \Exception
     * @return |\Illuminate\Database\Eloquent\Collection
     */
    public function showCourseByID(string $course_id){
        try{
            $course = Course::select('id','title','description','start_date')
            ->with('Instructors')
            ->findOrFail($course_id);
            return $course;
        }catch(Exception $e){
            Log::error('Error when show course '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * Summary of updateCourse
     * @param array $data
     * @param string $course_id
     * @throws \Exception
     * @return void
     */
    public function updateCourse(array $data,string $course_id){
        try{
            $course = Course::findOrFail($course_id);
            $course->update($data);
        }catch(Exception $e){
            Log::error('Error when update coures '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * Summary of deleteCourse
     * @param string $course_id
     * @throws \Exception
     * @return void
     */
    public function deleteCourse(string $course_id){
        try{
            $course = Course::findOrFail($course_id);
            $course->delete();
        }catch(Exception $e){
            Log::error('Error When delete coures '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    public function showUserInCourse(string $course_id){
        try{
            $course = Course::findOrFail($course_id);
            $studentInCourse = $course->students()->get();
            return $studentInCourse ;
        }catch(Exception $e){
            Log::error('Error when show user in course '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
}
