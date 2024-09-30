<?php
namespace App\Service\Student;

use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\Log;

class StudentService{
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
}
