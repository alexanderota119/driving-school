<?php

namespace App\Http\Requests;

class TenantSaveRequest extends BaseFormRequest
{
    /**
     * Get the shared validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function shared(): array
    {
        return $this->addFile() + [
            'name'    => 'string',
            'domains' => 'array',
            'data'    => '',
            'bgcolor' => '',
            'fgcolor' => '',
        ];
    }

    protected function store(): array
    {
        return [
            'tenant_name'  => ['required', 'min:2', 'unique:tenants,id'],
            'first_name'   => ['required'],
            'middle_name'  => [],
            'last_name'    => ['required'],
            'email'        => ['required'],
            'phone_number' => [],
        ] + $this->addPassword(true) + $this->addAddress();
    }
}
