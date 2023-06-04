<?php

namespace App\Http\Requests;

class NoteSaveRequest extends BaseFormRequest
{
    /**
     * Get the shared validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function shared(): array
    {
        return [
            'text'          => ['required'],
            'noteable_type' => ['required'],
            'noteable_id'   => ['required'],
            'userable_type' => [],
            'userable_id'   => [],
        ];
    }
}
