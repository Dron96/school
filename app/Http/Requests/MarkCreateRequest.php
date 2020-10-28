<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarkCreateRequest extends FormRequest
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
            'teacher_id' => 'integer|required|exists:workers,id',
            'subject_id' => 'integer|required|exists:subjects,id',
            'pupil_id' => 'integer|required|exists:pupils,id',
            'mark' => 'integer|required|max:5|min:1'
        ];
    }
}
