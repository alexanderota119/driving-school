<?php

namespace App\Http\Requests;

class PaymentTypeSaveRequest extends BaseFormRequest
{
    /**
     * Get the shared validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function shared(): array
    {
        return [
            'name' => ['required'],
        ];
    }
}
