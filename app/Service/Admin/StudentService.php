<?php
namespace App\Service\Admin;

use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\Log;

class StudentService{
    /**
     * Summary of createStudent
     * @param array $data
     * @throws \Exception
     * @return
     */
    public function createStudent(array $data){
        try{
            $student = Student::create($data);
            return $student ;
        }catch(Exception $e){
            Log::error('Error when create student '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * Summary of showStudentByID
     * @param string $student_id
     * @throws \Exception
     * @return mixed
     */
    public function showStudentByID(string $student_id){
        try{
            $student = Student::select('name','email')->with('courses')->findOrFail($student_id);
            return $student;
        }catch(Exception $e){
            Log::error('Error when show student '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * Summary of updateStudent
     * @param array $data
     * @param string $student_id
     * @throws \Exception
     * @return void
     */
    public function updateStudent(array $data , string $student_id){
        try{
            $student = Student::findOrFail($student_id);
            $student->update($data);
        }catch(Exception $e){
            Log::error('Error when update student '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * Summary of deleteStudent
     * @param string $student_id
     * @throws \Exception
     * @return void
     */
    public function deleteStudent(string $student_id){
        try{
            $student = Student::findOrFail($student_id);
            $student->delete();
        }catch(Exception $e){
            Log::error('Error when delete student '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    /**
     * Summary of registerStudentInCourse
     * @param array $data
     * @param string $student_id
     * @throws \Exception
     * @return mixed
     */
    public function registerStudentInCourse(array $data , string $student_id){
        try{
            $student = Student::findOrFail($student_id);
            $student->courses()->syncWithoutDetaching($data['courses_id']);

            //To show courses where user registered in it
            $courses = $student->courses()->select('courses.title', 'courses.description', 'courses.start_date')
            ->get()
            ->makeHidden('pivot');// To make pivot table information

            return $courses;
        }catch(Exception $e){
            Log::error('Error when register student '.$e->getMessage());
            throw new Exception('There is an error in server');
        }
    }
}
