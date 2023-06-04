<?php

namespace App\Http\Requests;

class InstructorSaveRequest extends BaseFormRequest
{
    /**
     * Get the shared validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function shared(): array
    {
        return [
            'first_name'     => ['required'],
            'last_name'      => ['required'],
            'middle_name'    => [],
            'email'          => [],
            'phone'          => [],
            'car_id'         => ['required'],
            'school_id'      => [],
            'remember_token' => [],
            'name'           => [],
            'status_id'      => [],
            'is_inactive'    => [],
        ];
    }

    protected function update(): array
    {
        return $this->addPassword(false);
    }

    protected function store(): array
    {
        return $this->addPassword(true);
    }
}
