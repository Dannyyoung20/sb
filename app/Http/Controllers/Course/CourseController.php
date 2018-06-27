<?php

namespace App\Http\Controllers\Course;

use App\Models\Course;
use App\Models\BookedCourse;
use App\Transformers\CourseTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json(
            fractal()->collection($courses)
                ->parseIncludes(['tutor', 'category'])
                ->transformWith(new CourseTransformer)
                ->toArray());
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
        $booked->slug = uniqid(true);

        $booked->save();

        return response()->json([
            'message' => 'Course booked successfully'
        ],200);
    }
}
