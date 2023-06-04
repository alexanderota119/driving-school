<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolSaveRequest;
use App\Http\Resources\Api\SchoolResource;
use App\Jobs\SaveEntityAddressJob;
use App\Models\School;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        /**
         * @get('/schools')
         * @name('schools.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $schools = SchoolResource::collection(School::all());

        return inertia('School/Manage', [
            'schools' => SchoolResource::collection($schools),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SchoolSaveRequest  $request
     * @return RedirectResponse
     */
    public function store(SchoolSaveRequest $request): RedirectResponse
    {
        /**
         * @post('/schools')
         * @name('schools.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $data = $request->validated();
        $address = \Arr::pull($data, 'address');

        $school = School::create($data);

        if ($address) {
            $school->address()->create($address);
        }

        return redirect()->route('schools.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        /**
         * @get('/schools/create')
         * @name('schools.create')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('School/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  School  $school
     * @return Response|ResponseFactory
     */
    public function show(School $school): Response|ResponseFactory
    {
        /**
         * @get('/schools/{school}')
         * @name('schools.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('School/Show', [
            'school' => SchoolResource::make($school),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  School  $school
     * @return Response|ResponseFactory
     */
    public function edit(School $school): Response|ResponseFactory
    {
        /**
         * @get('/schools/{school}/edit')
         * @name('schools.edit')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $school->load(['address', 'notes', 'myNotes']);

        return inertia('School/Edit', [
            'school' => SchoolResource::make($school),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  School  $school
     * @return RedirectResponse
     */
    public function update(SchoolSaveRequest $request, School $school): RedirectResponse
    {
        /**
         * @methods('PUT', PATCH')
         * @uri('/schools/{school}')
         * @name('schools.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $data = $request->validated();
        $address = \Arr::pull($data, 'address');

        $school->update($data);

        if ($request->has('address')) {
            $this->dispatch(
                new SaveEntityAddressJob(
                    entity: $school,
                    address: $request->input('address')
                ),
            );
        }

        return redirect()->route('schools.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  School  $school
     * @return RedirectResponse
     */
    public function destroy(School $school): RedirectResponse
    {
        /**
         * @delete('/schools/{school}')
         * @name('schools.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $school->delete();

        return redirect()->route('schools.index');
    }
}
