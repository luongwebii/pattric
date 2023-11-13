<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseTopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'course_lesson_id' => 'required',
            'courses_topics_name' => 'required',
            'courses_topics_author' => 'required',
            'courses_topics_content' => 'required',
            'courses_topics_embed_code' => 'nullable',

            'courses_topics_order' => 'nullable',
            'courses_topics_active' => 'nullable',

            'file_name' => 'nullable',
            'file_path' => 'nullable',
            'order_image' => 'nullable',
            'order_image_id' => 'nullable',
          

   
        ];
    }

   
}
