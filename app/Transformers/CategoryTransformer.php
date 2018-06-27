<?php

namespace App\Transformers;
use League\Fractal\TransformerAbstract;

use App\Models\Category;

class CategoryTransformer extends TransformerAbstract
{
	public function transform(Category $category)
	{
		return [
			'title' => $category->title,
			'category_image' => $category->image
		];
	}
}