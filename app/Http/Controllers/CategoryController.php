<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Course;

class CategoryController extends Controller
{
    public function index() 
    {
        // Eager loading the courses with categories
        $categories = Category::with('courses')
        ->latest()
        ->get();

        return response()->json($categories);
    }
 
    public function show($id) 
    {
        $category = Category::find($id);
        return response()->json($category);
  
    }

}
