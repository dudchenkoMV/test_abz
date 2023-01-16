<?php

namespace App\Http\Requests;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'photo' => ['image', 'mimes:jpg,png', 'dimensions:min_width=300,min_height=300', 'max:5120'],
            'position_id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'min:2', 'max:256'],
            'phone' => ['required', new PhoneRule],
            'email' => ['required', 'email', 'string'],
            'salary' => ['required', 'numeric'],
            'employment_at' => ['required', 'date', 'before_or_equal:-18 years'],
        ];
    }
}
