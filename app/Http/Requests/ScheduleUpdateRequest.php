<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleUpdateRequest extends FormRequest
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
            'subject_id' => 'integer|exists:subjects,id',
            'class' => 'integer|max:11|min:0',
            'parallel' => 'string|size:1',
            'start_lesson' => 'date_format:d.m.Y H:i'
        ];
    }
}
