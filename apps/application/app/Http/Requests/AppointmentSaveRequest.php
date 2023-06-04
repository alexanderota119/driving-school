<?php

namespace App\Http\Requests;

class AppointmentSaveRequest extends BaseFormRequest
{
    /**
     * Get the shared validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function shared(): array
    {
        return [
            'instructor_id'       => [],
            'date'                => ['required', 'date'],
            'time_start'          => ['required'],
            'time_end'            => ['required'],
            'appointment_type_id' => ['required'],
            'test_location_id'    => ['required'],
            'test_passed'         => [],
            'cancelled_date'      => [],
            'cancelled_comment'   => [],
            'car_id'              => [],
            'pickup_location_id'  => [],
            'dl304a'              => [],
            'dl304c'              => [],
        ];
    }

//    protected function update(): array
//    {
//        return [
//            'student_id'          => [],
//            'instructor_id'       => [],
//            'creator_id'          => [],
//            'date'                => [],
//            'time_start'          => [],
//            'time_end'            => [],
//            'appointment_type_id' => [],
//            'test_location_id'    => [],
//            'test_passed'         => [],
//            'cancelled_date'      => [],
//            'cancelled_comment'   => [],
//            'car_id'              => [],
//            'pickup_location_id'  => [],
//            'dl304a'              => [],
//            'dl304c'              => [],
//        ];
//    }
}
