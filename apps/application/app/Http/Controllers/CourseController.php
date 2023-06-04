<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseSaveRequest;
use App\Http\Resources\Api\CourseResource;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        /**
         * @get('/courses')
         * @name('courses.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $courses = CourseResource::collection(Course::all());

        return inertia('Course/Manage', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CourseSaveRequest  $request
     * @return RedirectResponse
     */
    public function store(CourseSaveRequest $request): RedirectResponse
    {
        /**
         * @post('/courses')
         * @name('courses.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        Course::create($request->validated());

        return redirect()->route('courses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        /**
         * @get('/courses/create')
         * @name('courses.create')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Course/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  Course  $course
     * @return Response|ResponseFactory
     */
    public function show(Course $course): Response|ResponseFactory
    {
        /**
         * @get('/courses/{course}')
         * @name('courses.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $course->load(['address', 'notes', 'ratings']);
        $course->append('rating');

        return inertia('Course/Show', [
            'course' => new CourseResource($course),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Course  $course
     * @return Response|ResponseFactory
     */
    public function edit(Course $course): Response|ResponseFactory
    {
        /**
         * @get('/courses/{course}/edit')
         * @name('courses.edit')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $course->load(['address', 'notes', 'ratings']);
        $course->append('rating');

        return inertia('Course/Edit', [
            'course' => new CourseResource($course),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CourseSaveRequest  $request
     * @param  Course  $course
     * @return RedirectResponse
     */
    public function update(CourseSaveRequest $request, Course $course): RedirectResponse
    {
        /**
         * @methods('PUT', PATCH')
         * @uri('/courses/{course}')
         * @name('courses.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $course->update($request->validated());

        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Course  $course
     * @return RedirectResponse
     */
    public function destroy(Course $course): RedirectResponse
    {
        /**
         * @delete('/courses/{course}')
         * @name('courses.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $course->delete();

        return redirect()->back();
    }
}
