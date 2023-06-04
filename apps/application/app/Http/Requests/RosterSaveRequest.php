<?php

namespace App\Http\Requests;

class RosterSaveRequest extends BaseFormRequest
{
    /**
     * Get the shared validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function shared(): array
    {
        return [
            'name'           => ['required'],
            'class_time'     => ['required'],
            'is_test_passed' => ['boolean'],
            'student_id'     => ['required'],
            'course_id'      => ['required'],
        ];
    }
}
