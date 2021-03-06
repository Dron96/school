<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserToPupilRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id|unique:pupils,user_id|unique:workers,user_id',
            'admission_date' => 'required|date_format:d.m.Y',
            'class' => 'integer|required|min:0|max:11',
            'parallel' => 'required|size:1|string',
        ];
    }
}
