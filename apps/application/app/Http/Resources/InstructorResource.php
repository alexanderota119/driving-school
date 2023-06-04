<?php

namespace App\Http\Resources;

use App\Http\Resources\Api\CarResource;
use App\Http\Resources\Api\SchoolResource;
use App\Models\Instructor;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin Instructor
 */
class InstructorResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function getArray($request): array|JsonSerializable|Arrayable
    {
        $this->addStandardNeeds();

        return [
            'type'   => 'instructor',
            'avatar' => route('instructor.avatar', $this),

            'name'        => $this->name,
            'first_name'  => $this->first_name,
            'last_name'   => $this->last_name,
            'middle_name' => $this->middle_name,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'car_id'      => $this->car_id,
            'school_id'   => $this->school_id,
            'is_inactive' => (bool) $this->is_inactive,

            'car'    => CarResource::make($this->whenLoaded('car')),
            'school' => SchoolResource::make($this->whenLoaded('school')),
        ];
    }
}
