<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CarUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'make'  => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:100'],
            'color' => ['required', 'string', 'max:100'],
            'year'  => ['required', 'string'],
        ];
    }
}
