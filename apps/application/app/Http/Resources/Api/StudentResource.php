<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseJsonResource;
use App\Http\Resources\PaymentResource;
use App\Models\Student;
use Illuminate\Http\Request;

/**
 * @mixin Student
 */
class StudentResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function getArray($request): array
    {
        $this->addStandardNeeds();

        return [
            'type'            => 'student',
            'avatar'          => route('student.avatar', $this),
            'name'            => $this->name,
            'first_name'      => $this->first_name,
            'last_name'       => $this->last_name,
            'middle_name'     => $this->middle_name,
            'email'           => $this->email,
            'student_type_id' => $this->student_type_id,
            'school_id'       => $this->school_id,
            'car_id'          => $this->car_id,
            'is_inactive'     => (bool) $this->is_inactive,

            'student_type' => $this->whenLoaded('studentType', StudentTypeResource::make($this->studentType)),
            'school'       => $this->whenLoaded('school', SchoolResource::make($this->school)),
            'payments'     => $this->whenLoaded('payments', PaymentResource::collection($this->payments)),
            'car'          => $this->whenLoaded('car', CarResource::make($this->car)),
        ];
    }
}
