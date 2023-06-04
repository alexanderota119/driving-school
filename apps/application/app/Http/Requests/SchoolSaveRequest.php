<?php

namespace App\Http\Requests;

class SchoolSaveRequest extends BaseFormRequest
{
    /**
     * Get the shared validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function shared(): array
    {
        return $this->addAddress() + [
            'name' => ['required', 'min:3'],
        ];
    }
}
