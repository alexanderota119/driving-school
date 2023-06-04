<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name'  => ['required', 'string', 'max:100'],
            'last_name'   => ['required', 'string', 'max:100'],
            'middle_name' => ['string', 'max:100'],
            'email'       => ['email', 'max:100'],
            'password'    => ['sometimes', 'required', 'password', 'max:100'],
        ];
    }
}
