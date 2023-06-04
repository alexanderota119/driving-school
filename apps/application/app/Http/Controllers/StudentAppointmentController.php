<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentSaveRequest;
use App\Http\Resources\Api\StudentResource;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Student;

class StudentAppointmentController extends Controller
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
         * @get('/students/{student}/appointments')
         * @name('students.appointments.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $student->load([
            // 'appointments.car',
            // 'appointments.instructor',
            // 'appointments.appointment_type',
            // 'appointments.test_location',
            // 'appointments.pickup_location',
            // 'appointments.instructor.car',
            'school',
        ]);

        return inertia('Student/Appointment/Manage', [
            'student' => StudentResource::make($student),
            // 'appointments' => AppointmentResource::collection($student->appointments),
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
         * @post('/students/{student}/appointments')
         * @name('students.appointments.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $student->appointments()->create($request->validated());

        return redirect()->route('students.appointments.index', $student);
//        return response()->noContent();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function create(Student $student)
    {
        /**
         * @get('/students/{student}/appointments/create')
         * @name('students.appointments.create')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Student/Appointment/Create', [
            'student' => StudentResource::make($student),
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
         * @get('/students/{student}/appointments/{appointment}')
         * @name('students.appointments.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Student/Appointment/Show', [
            'student' => StudentResource::make($student),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student, Appointment $appointment)
    {
        /**
         * @get('/students/{student}/appointments/{appointment}/edit')
         * @name('students.appointments.edit')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Student/Appointment/Edit', [
            'student'     => new StudentResource($student),
            'appointment' => new AppointmentResource($appointment),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AppointmentSaveRequest  $request
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentSaveRequest $request, Student $student, Appointment $appointment)
    {
        /**
         * @methods('PUT', PATCH')
         * @uri('/students/{student}/appointments/{appointment}')
         * @name('students.appointments.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $appointment->update($request->validated());

        return redirect()->route('students.appointments.index', [$student]);
//        return response()->noContent();
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
         * @delete('/students/{student}/appointments/{appointment}')
         * @name('students.appointments.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $appointment->delete();

        return redirect()->route('students.appointments.index', [$student]);
//        return response()->noContent();
    }
}
