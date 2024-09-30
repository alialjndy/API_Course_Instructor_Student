<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'start_date'
    ];
    protected $hidden = ['pivot'];
    public function Instructors(){
        return $this->belongsToMany(Instructor::class ,'Course_Instructor')->withTimestamps();
    }
    public function students(){
        return $this->belongsToMany(Student::class , 'Course_Student')->withTimestamps();
    }
}
