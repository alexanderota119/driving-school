<?php

namespace App\Http\Requests;

class SpecialEventSaveRequest extends BaseFormRequest
{
    /**
     * Get the shared validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function shared(): array
    {
        return $this->addAddress() + [
            'name'       => ['required'],
            'date_start' => ['required'],
            'end_date'   => ['required'],
        ];
    }
}
