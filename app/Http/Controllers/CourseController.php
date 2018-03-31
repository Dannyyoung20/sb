<?php

namespace App\Http\Controllers;

use App\Course;
use App\BookedCourse;
use Illuminate\Http\Request;
use Carbon;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    public function show($id) 
    {
        $course = Course::findOrFail($id);
        $tutor = $course->tutor;
        return response()->json($course);
    }

    public function bookCourse(Request $request) 
    {
        $booked = new BookedCourse();
        $booked->course_id = $request->course_id;
        $booked->tutor_id = $request->tutor_id;
        $booked->student_id = $request->student_id;
        $booked->start_date = Carbon::now();

        $booked->save();

        return response()->json([
            'message' => 'Course booked successfully'
        ],201);
    }
}
