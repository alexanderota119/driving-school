<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class DropdownStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:100'],
            'slug'      => ['required', 'string', 'max:100'],
            'type_name' => ['required', 'string', 'max:50'],
        ];
    }
}
