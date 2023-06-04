<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\StudentSaveRequest;
use App\Http\Resources\Api\StudentResource;
use App\Jobs\PhoneSaveJob;
use App\Jobs\SaveEntityAddressJob;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        /**
         * @get('/students')
         * @name('students.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $students = Student::with('studentType', 'school', 'address')->orderBy('student_type_id')->get();

        return inertia('Student/Manage', [
            'students' => StudentResource::collection($students),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStudentRequest  $request
     * @return RedirectResponse
     */
    public function store(StudentSaveRequest $request): RedirectResponse
    {
        /**
         * @post('/students')
         * @name('students.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $student = Student::create($request->validated());

        if ($request->has('address')) {
            $new_address = $this->dispatch(
                new SaveEntityAddressJob(
                    entity: $student,
                    address: $request->get('address'),
                )
            );
        }

        if ($phone = $request->get('phone')) {
            $this->dispatch(
                new PhoneSaveJob(
                    entity: $student,
                    phone: $phone
                )
            );
        }

        return redirect()->route('students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        /**
         * @get('/students/create')
         * @name('students.create')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Student/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  Student  $student
     * @return Response|ResponseFactory
     */
    public function show(Student $student): Response|ResponseFactory
    {
        /**
         * @get('/students/{student}')
         * @name('students.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $student->load([
            'phones',
            'address',
            'notes',
            'ratings',
        ]);

        return inertia('Student/Show', [
            'student' => StudentResource::make($student),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Student  $student
     * @return Response|ResponseFactory
     */
    public function edit(Student $student): Response|ResponseFactory
    {
        /**
         * @get('/students/{student}/edit')
         * @name('students.edit')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $student->load('address');

        return inertia('Student/Edit', [
            'student' => StudentResource::make($student),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StudentSaveRequest  $request
     * @param  Student  $student
     * @return RedirectResponse
     */
    public function update(StudentSaveRequest $request, Student $student): RedirectResponse
    {
        /**
         * @methods('PUT', PATCH')
         * @uri('/students/{student}')
         * @name('students.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $student->update($request->validated());

        if ($request->get('address')) {
            $new_address = $this->dispatch(
                new SaveEntityAddressJob(
                    entity: $student,
                    address: $request->get('address'),
                )
            );
        }

        if ($phone = $request->get('phone')) {
            $this->dispatch(
                new PhoneSaveJob(
                    entity: $student,
                    phone: $phone
                )
            );
        }

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Student  $student
     * @return RedirectResponse
     */
    public function destroy(Student $student): RedirectResponse
    {
        /**
         * @delete('/students/{student}')
         * @name('students.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $student->delete();

        return redirect()->route('students.index');
    }
}
