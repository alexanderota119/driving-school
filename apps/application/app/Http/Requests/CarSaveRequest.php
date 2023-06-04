<?php

namespace App\Http\Requests;

class CarSaveRequest extends BaseFormRequest
{
    /**
     * Get the shared validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function shared(): array
    {
        return [
            'name'          => [],
            'license_plate' => [],
            'make'          => ['required'],
            'model'         => ['required'],
            'color'         => ['required'],
            'year'          => ['required', 'integer'],
        ];
    }
}
