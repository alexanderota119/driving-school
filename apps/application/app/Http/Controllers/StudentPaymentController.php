<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentsSaveRequest;
use App\Http\Resources\Api\StudentResource;
use App\Http\Resources\PaymentResource;
use App\Models\Payments;
use App\Models\Student;

class StudentPaymentController extends Controller
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
         * @get('/students/{student}/payments')
         * @name('students.payments.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $student->load(['payments.payment_type', 'payments.course', 'school']);

        return inertia('Student/Payment/Manage', [
            'student' => new StudentResource($student),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentsSaveRequest $request, Student $student)
    {
        /**
         * @post('/students/{student}/payments')
         * @name('students.payments.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $student->payments()->create($request->validated());

        return redirect()->route('students.payments.index', $student);
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
         * @get('/students/{student}/payments/create')
         * @name('students.payments.create')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Student/Payment/Create', [
            'student' => new StudentResource($student),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Payments  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student, Payments $payment)
    {
        /**
         * @get('/students/{student}/payments/{payment}')
         * @name('students.payments.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $student->load(['payments.payment_type', 'payments.course', 'school']);

        return inertia('Student/Payment/Show', [
            'student' => new StudentResource($student),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Payments  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student, Payments $payment)
    {
        /**
         * @get('/students/{student}/payments/{payment}/edit')
         * @name('students.payments.edit')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Student/Payment/Edit', [
            'student' => new StudentResource($student),
            'payment' => new PaymentResource($payment),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Payments  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentsSaveRequest $request, Student $student, Payments $payment)
    {
        /**
         * @methods('PUT', PATCH')
         * @uri('/students/{student}/payments/{payment}')
         * @name('students.payments.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $payment->update($request->validated());

        return redirect()->route('students.payments.index', $student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Payments  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student, Payments $payment)
    {
        /**
         * @delete('/students/{student}/payments/{payment}')
         * @name('students.payments.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $payment->delete();

        return redirect()->route('students.payments.index', $student);
    }
}
