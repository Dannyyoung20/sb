<?php

namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Transformers\TutorTransformer;
use App\Transformers\CategoryTransformer;

use App\Models\Course;

class CourseTransformer extends TransformerAbstract
{   
    protected $availableIncludes = [
        'tutor', 'category'
    ];

    public function transform(Course $course)
    {
        return [
        	'id' => $course->slug,
        	'title' => $course->title,
        	'description' => $course->description,
        	'image_url' => $course->image,
        	'created' => $course->created_at->toDateTimeString(),
        	'created_human' => $course->created_at->diffForHumans()
        ];	
    }

    public function includeTutor(Course $course)
    {
        return $this->item($course->tutor->first(), new TutorTransformer);
    }

    public function includeCategory(Course $course)
    {
        return $this->item($course->category->first(), new CategoryTransformer);
    }
}
