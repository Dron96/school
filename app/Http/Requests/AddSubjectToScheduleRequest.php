<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSubjectToScheduleRequest extends FormRequest
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
            'subject_id' => 'integer|required|exists:subjects,id',
            'class' => 'required|integer|max:11|min:0',
            'parallel' => 'required|string|size:1',
            'start_lesson' => 'required|date_format:d.m.Y H:i'
        ];
    }
}
