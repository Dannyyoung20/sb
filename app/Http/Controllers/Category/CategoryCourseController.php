<?php

namespace App\Http\Controllers\Category;

use App\Course;
use App\Category;
use Illuminate\Http\Request;

class CategoryCourseController extends Controller
{
    public function index($category_id) 
    {
        $category = Category::findOrFail($category_id);
        return response()->json($category->courses);
    }
}
