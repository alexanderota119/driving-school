<?php

namespace App\Http\Requests;

class AppointmentTypeSaveRequest extends BaseFormRequest
{
    /**
     * Get the shared validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function shared(): array
    {
        return [
            'name'        => ['required'],
            'duration'    => ['required'],
            'is_test'     => [],
            'test_offset' => [],
            'order'       => [],
        ];
    }
}
