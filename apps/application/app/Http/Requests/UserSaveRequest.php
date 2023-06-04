<?php

namespace App\Http\Requests;

class UserSaveRequest extends BaseFormRequest
{
    /**
     * Get the shared validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function shared(): array
    {
        return $this->addAddress() + $this->addEmail() + $this->addPassword(false) + [
            'first_name'  => ['required'],
            'middle_name' => [],
            'last_name'   => ['required'],
            'name'        => [],
            'status_id'   => [],
            'is_inactive' => [],
        ];
    }
}
