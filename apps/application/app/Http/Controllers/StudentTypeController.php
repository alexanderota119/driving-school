<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentTypeSaveRequest;
use App\Http\Resources\Api\StudentTypeResource;
use App\Models\StudentType;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class StudentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        /**
         * @get('/student_types')
         * @name('student_types.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $student_types = StudentType::all();

        return inertia('StudentType/Manage', [
            'student_types' => StudentTypeResource::collection($student_types),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StudentTypeSaveRequest  $request
     * @return RedirectResponse
     */
    public function store(StudentTypeSaveRequest $request): RedirectResponse
    {
        /**
         * @post('/student_types')
         * @name('student_types.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        StudentType::create($request->validated());

        return redirect()->route('student_types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        /**
         * @get('/student_types/create')
         * @name('student_types.create')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('StudentType/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  StudentType  $studentType
     * @return Response|ResponseFactory
     */
    public function show(StudentType $studentType): Response|ResponseFactory
    {
        /**
         * @get('/student_types/{student_type}')
         * @name('student_types.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('StudentType/Show', [
            'student_type' => StudentTypeResource::make($studentType),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  StudentType  $studentType
     * @return Response|ResponseFactory
     */
    public function edit(StudentType $studentType): Response|ResponseFactory
    {
        /**
         * @get('/student_types/{student_type}/edit')
         * @name('student_types.edit')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('StudentType/Edit', [
            'student_type' => StudentTypeResource::make($studentType),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StudentTypeSaveRequest  $request
     * @param  StudentType  $studentType
     * @return RedirectResponse
     */
    public function update(StudentTypeSaveRequest $request, StudentType $studentType): RedirectResponse
    {
        /**
         * @methods('PUT', PATCH')
         * @uri('/student_types/{student_type}')
         * @name('student_types.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $t = $request->validated();
        $studentType->update($request->validated());

        return redirect()->route('student_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  StudentType  $studentType
     * @return RedirectResponse
     */
    public function destroy(StudentType $studentType): RedirectResponse
    {
        /**
         * @delete('/student_types/{student_type}')
         * @name('student_types.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $studentType->delete();

        return redirect()->route('student_types.index');
    }
}
