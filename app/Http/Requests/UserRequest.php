<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class UserRequest extends FormRequest
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
    public function rules() : array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', 'string', 'min:8'],
            'ktp_no'        => [
                'required',
                'numeric',
                'regex:/^[0-9]+$/',
                'digits:16'
            ],
            'phone_number'        => [
                'required',
                'digits_between:9,16',
                'regex:/^628\d+$/',
            ],
            'addres' => ['required', 'string', 'max:255'],
        ];
    }
}
