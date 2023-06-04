<?php

namespace App\Http\Requests;

class PaymentsSaveRequest extends BaseFormRequest
{
    /**
     * Get the shared validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function shared(): array
    {
        return [
            'amount'          => ['required'],
            'course_id'       => [],
            'payment_type_id' => ['required'],
        ];
    }
}
