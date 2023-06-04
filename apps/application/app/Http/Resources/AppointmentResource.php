<?php

namespace App\Http\Resources;

use App\Helpers\Date;
use App\Http\Resources\Api\AddressResource;
use App\Http\Resources\Api\CarResource;
use App\Http\Resources\Api\StudentResource;
use App\Http\Resources\Api\TestLocationResource;
use App\Models\Appointment;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin Appointment
 */
class AppointmentResource extends BaseJsonResource
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
            'cancelled_comment' => $this->cancelled_comment,
            'dl304a'            => $this->dl304a,
            'dl304c'            => $this->dl304c,

            'appointment_type_id' => $this->appointment_type_id,
            'test_location_id'    => $this->test_location_id,
            'pickup_location_id'  => $this->pickup_location_id,
            'student_id'          => $this->student_id,
            'instructor_id'       => $this->instructor_id,
            'creator_id'          => $this->creator_id,
            'car_id'              => $this->car_id,

            'cancelled_date'     => $this->cancelled_date,
            'cancelled_date_fmt' => optional($this->cancelled_date)->format(config('app.table-datetime-format')),
            'test_passed'        => $this->test_passed,
            'test_passed_fmt'    => optional($this->test_passed)->format(config('app.table-datetime-format')),
            'time_start'         => $this->time_start,
            'time_start_fmt'     => optional($this->time_start)->format(config('app.table-time-format')),
            'time_end'           => $this->time_end,
            'time_end_fmt'       => optional($this->time_end)->format(config('app.table-time-format')),
            'date'               => Date::dateObject($this->date),
            'date_fmt'           => optional($this->date)->format(config('app.table-date-format')),

            'car'              => $this->whenLoaded('car', CarResource::make($this->car)),
            'appointment_type' => $this->whenLoaded('appointment_type', AppointmentTypeResource::make($this->appointment_type)),
            'test_location'    => $this->whenLoaded('test_location', TestLocationResource::make($this->test_location)),
            'pickup_location'  => $this->whenLoaded('pickup_location', AddressResource::make($this->pickup_location)),
            'student'          => $this->whenLoaded('student', StudentResource::make($this->student)),
            'instructor'       => $this->whenLoaded('instructor', InstructorResource::make($this->instructor)),
            'creator'          => $this->whenLoaded('creator', CarResource::make($this->creator)),

            // Calendar Props
            'start' => optional($this->date)->format(config('app.database-date-format')),
        ];
    }
}
