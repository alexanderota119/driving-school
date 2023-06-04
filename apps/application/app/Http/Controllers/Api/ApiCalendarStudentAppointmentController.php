<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentSaveRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\CalendarResource;
use App\Models\Appointment;
use App\Models\Student;

class ApiCalendarStudentAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function index(Student $student)
    {
        /**
         * @get('/api/students/{student}/appointments')
         * @name('students.appointments.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return CalendarResource::collection($student->appointments)
            ->additional([
                'appointments' => AppointmentResource::collection($student->appointments)->keyBy('id'),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentSaveRequest $request, Student $student)
    {
        /**
         * @post('/api/students/{student}/appointments')
         * @name('students.appointments.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return response()->json([
            'appointment' => AppointmentResource::make($student->appointments()->create($request->validated())),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student, Appointment $appointment)
    {
        /**
         * @get('/api/students/{student}/appointments/{appointment}')
         * @name('students.appointments.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return response()->json([
            'appointment' => AppointmentResource::make($appointment),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentSaveRequest $request, Student $student, Appointment $appointment)
    {
        /**
         * @methods('PUT', PATCH')
         * @uri('/api/students/{student}/appointments/{appointment}')
         * @name('students.appointments.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $appointment->update($request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student, Appointment $appointment)
    {
        /**
         * @delete('/api/students/{student}/appointments/{appointment}')
         * @name('students.appointments.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $appointment->delete($request->validated());

        return response()->noContent();
    }
}
