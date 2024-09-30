<?php
namespace App\Service\Admin;

use App\Models\Instructor;
use Exception;
use Illuminate\Support\Facades\Log;

class InstuctorService{
    public function createInstructor(array $data){
        try{
            $Instructor = Instructor::create($data);
            return $Instructor ;
        }catch(Exception $e){
            Log::error('Error when create Instructor '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    public function showInstructorByID(string $Instructor_id){
        try{
            $Instructor = Instructor::select('id','name','experience','speciality')->with('courses')->findOrFail($Instructor_id);
            return $Instructor;
        }catch(Exception $e){
            Log::error('Error when show Instructor '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    public function updateInstructor(array $data , string $Instructor_id){
        try{
            $Instructor = Instructor::findOrFail($Instructor_id);
            $Instructor->update($data);
        }catch(Exception $e){
            Log::error('Error when update Instructor '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    public function deleteInstructor(string $Instructor_id){
        try{
            $Instructor = Instructor::findOrFail($Instructor_id);
            $Instructor->delete();
        }catch(Exception $e){
            Log::error('Error when delete Instructor '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    public function courseRelatedWithIns(string $Instructor_id){
        try{
            $Instructor = Instructor::findOrFail($Instructor_id);
            $info = $Instructor->courses()->get();
            return $info ;
        }catch(Exception $e){
            Log::error('Error when show course Related With Ins Instructor '.$e->getMessage());
            throw new Exception('There is an error in server.');
        }
    }
    public function studentRelatedWithIns(string $Instructor_id){
        try{
            $Instructor = Instructor::findOrFail($Instructor_id);
            $info = $Instructor->students()->get();
            return $info ;
        }catch(Exception $e){
            Log::error('Error when show student Related With Ins Instructor Instructor '.$e->getMessage());
            throw new Exception('There is an error in server '.$e->getMessage());
        }
    }
}
