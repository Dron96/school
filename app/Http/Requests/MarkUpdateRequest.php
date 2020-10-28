<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarkUpdateRequest extends FormRequest
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
            'teacher_id' => 'integer|exists:workers,id',
            'subject_id' => 'integer|exists:subjects,id',
            'pupil_id' => 'integer|exists:pupils,id',
            'mark' => 'integer|max:5|min:1'
        ];
    }
}
