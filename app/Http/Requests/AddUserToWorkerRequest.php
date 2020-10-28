<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddUserToWorkerRequest extends FormRequest
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
            'role' => [
                'required',
                Rule::in(['Учитель', 'Завуч', 'Директор'])
            ],
            'employment_date' => 'required|date_format:d.m.Y',
            'dismissal_date' => 'required|date_format:d.m.Y|after:employment_date|nullable',
            'user_id' => 'required|integer|exists:users,id|unique:workers,user_id|unique:pupils,user_id',
        ];
    }
}
