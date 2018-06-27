<?php

namespace App\Transformers;
use League\Fractal\TransformerAbstract;

use App\Models\Tutor;

class TutorTransformer extends TransformerAbstract
{
	public function transform(Tutor $tutor)
	{
		return [
			'id' => $tutor->slug,
			'fullname' => $tutor->firstname .' '. $tutor->lastname,
			'phone' => $tutor->phone,
			'email' => $tutor->email,
			'profile_pic' => $tutor->image
		];
	}
}