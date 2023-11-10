<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizRequest extends FormRequest
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
            'course_lesson_topic_id' => 'required',
            'quizzes_name' => 'required',
            'quizzes_desc' => 'nullable',
            'questions' => 'nullable',
            
   
        ];
    }

   
}
