# API_Courses_Instructor_Courses

## Project Overview

API_Courses_Instructor_Courses is a RESTful API that manages a system involving three types of users: Admin, Student, and Instructor. The API allows the Admin to perform CRUD operations for students, instructors, and courses. Additionally, students can view available courses and the instructors teaching each course. Admins can also view students under a specific instructor and the courses taught by a specific instructor.

## Users

1. **Admin**

    - Full access to manage students, instructors, and courses.
    - Can perform CRUD operations on:
        - Students
        - Instructors
        - Courses

2. **Student**

    - Can view:
        - All available courses along with the instructors teaching them.
        - Detailed information about a specific course, including the instructors for that course.

## Requirments

-   PHP Version 8.3 or earlier
-   Laravel Version 11 or earlier
-   composer
-   XAMPP: Local development environment (or a similar solution)

## API Endpoints

### Authentication

    - POST /api/admin/login: Log in with email and password (admin)
    - POST /api/student/login: Log in with email and password (student)
    - POST /api/Adminlogout: Log out the current user (for admin)
    - POST /api/Studentlogout: Log out the current user (for student)
    - GET /api/AdminInfo: display info currently user
    - GET /api/StudentInfo: display info currently user

### Crud Student

    - POST /api/students : Create student by admin
    - GET /api/students : show all students by admin
    - GET /api/students/{student_id} : show student by ID
    - PUT /api/students/{student_ID} : update student by ID
    - DELETE /api/students/{student_ID} : delete student by ID
    - POST /api/students/{id}/course : Register Student in course

### Crud instructors

    - POST /api/instructor : Create instructor by admin
    - GET /api/instructor : show all instructors by admin
    - GET /api/instructor/{instructor_id} : show instructor by ID
    - PUT /api/instructor/{instructor_ID} : update instructor by ID
    - DELETE /api/instructor/{instructor_ID} : delete instructor by ID
    - GET /api/instructors/{instructor_id}/course : show course related with teacher
    - GET /api/instructors/{instructor_id}/student : show students related with teacher

### Crud Course

    - POST /api/Course : Create Course by admin
    - GET /api/Course : show all instructors by admin
    - GET /api/Course/{course_id} : show Course by ID
    - PUT /api/Course/{course_ID} : update Course by ID
    - DELETE /api/Course/{course_ID} : delete Course by ID

### Action method

    -GET /api/AllCourse : show all course with teacher
    -GET /api/FetchCourse/{course_id} : show course by id

## Postman Collection:

You can access the Postman collection for this project by following this [link](https://documenter.getpostman.com/view/37833857/2sAXqzYJsL). The collection includes all the necessary API requests for testing the application.
