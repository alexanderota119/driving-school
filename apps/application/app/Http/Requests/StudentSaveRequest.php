<?php

namespace App\Http\Requests;

class StudentSaveRequest extends BaseFormRequest
{
    /**
     * Get the shared validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function shared(): array
    {
        return $this->addAddress() + $this->addEmail() + [
            'first_name'  => ['required', 'min:3'],
            'last_name'   => ['required', 'min:3'],
            'middle_name' => [],
            'status_id'   => [],
            'is_inactive' => [],

            'student_type_id' => ['required'],
            'school_id'       => [],
            'remember_token'  => [],
            'phone'           => [],
        ];
    }

    protected function store(): array
    {
        return $this->addPassword();
    }

    protected function update(): array
    {
        return $this->addPassword(false);
    }
}
