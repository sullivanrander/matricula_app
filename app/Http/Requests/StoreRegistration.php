<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRegistration extends FormRequest
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
            'status' => ['required', Rule::in(['ACTIVE', 'SUSPENDED', 'TERMINATED', 'DROPOUT', 'COMPLETED', 'PAUSED'])],
            'course' => ['required', Rule::exists('courses', 'id')],
            'student.name' => ['required', 'string', 'max:255'],
            'student.cpf' => ['required', 'string', 'size:11'],
            'student.born_date' => ['required', 'date'],
            'student.email' => ['required', 'string', 'max:255', 'email'],
            'student.telephone' => ['required', 'string', 'min:10', 'max:12'],
        ];
    }
}
