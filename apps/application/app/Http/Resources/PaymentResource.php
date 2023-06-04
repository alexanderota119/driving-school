<?php

namespace App\Http\Resources;

use App\Http\Resources\Api\CourseResource;
use App\Models\Payments;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin Payments
 */
class PaymentResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function getArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'amount'          => $this->amount,
            'student_id'      => $this->student_id,
            'course_id'       => $this->course_id,
            'payment_type_id' => $this->payment_type_id,

            'payment_type' => $this->whenLoaded('payment_type', PaymentTypeResource::make($this->payment_type)),
            'course'       => $this->whenLoaded('course', CourseResource::make($this->course)),
        ];
    }
}
