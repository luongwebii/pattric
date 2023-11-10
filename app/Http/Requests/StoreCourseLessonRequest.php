<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseLessonRequest extends FormRequest
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
            'course_id' => 'required',
            'courses_chapters_name' => 'required',
            'courses_chapters_title' => 'required',
            'courses_chapters_order' => 'required',
            'courses_chapters_active' => 'nullable',

            'courses_chapters_url' => 'nullable',
            'courses_chapters_page_title' => 'nullable',
            'courses_chapters_meta_description' => 'nullable',
            'courses_chapters_meta_keywords' => 'nullable',
           
   
        ];
    }

   
}
