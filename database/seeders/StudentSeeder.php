<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student = Student::create([
            'name'=>'albrens001',
            'email'=>'albrens001@gmail.com',
            'password'=>Hash::make('albrens001'),
            'role'=>'student'
        ]);
    }
}
