<?php

namespace App\Http\Requests;

class TimeOffSaveRequest extends BaseFormRequest
{
    /**
     * Get the shared validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function shared(): array
    {
        return [
            'date_time_off' => ['required'],
            'time_start'    => ['required'],
            'time_end'      => ['required'],
            'instructor_id' => ['required'],
            'recur_token'   => [],
            'comments'      => [],
        ];
    }
}
