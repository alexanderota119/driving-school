<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructorSaveRequest;
use App\Http\Resources\InstructorResource;
use App\Jobs\PhoneSaveJob;
use App\Jobs\SaveEntityAddressJob;
use App\Models\Instructor;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        /**
         * @get('/instructors')
         * @name('instructors.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $instructors = Instructor::withoutGlobalScope('active_only')->with('car')->get();

        return inertia('Instructor/Manage', [
            'instructors' => InstructorResource::collection($instructors),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\InstructorSaveRequest  $request
     * @return RedirectResponse
     */
    public function store(InstructorSaveRequest $request): RedirectResponse
    {
        /**
         * @post('/instructors')
         * @name('instructors.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $instructor = Instructor::create($request->validated());

        if ($phone = $request->get('phone')) {
            $this->dispatch(
                new PhoneSaveJob(
                    entity: $instructor,
                    phone: $phone
                )
            );
        }

        return redirect()->route('instructors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        /**
         * @get('/instructors/create')
         * @name('instructors.create')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Instructor/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return Response|ResponseFactory
     */
    public function show(Instructor $instructor): Response|ResponseFactory
    {
        /**
         * @get('/instructors/{instructor}')
         * @name('instructors.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Instructor/Show', [
            'instructor' => InstructorResource::make($instructor),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instructor  $any_instructor
     * @return Response|ResponseFactory
     */
    public function edit(Instructor $any_instructor): Response|ResponseFactory
    {
        /**
         * @get('/instructors/{instructor}/edit')
         * @name('instructors.edit')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $any_instructor->load('address.state', 'phone');

        return inertia('Instructor/Edit', [
            'instructor' => InstructorResource::make($any_instructor),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\InstructorSaveRequest  $request
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(InstructorSaveRequest $request, Instructor $instructor)
    {
        $data = $request->validated();

        /**
         * @methods('PUT', PATCH')
         * @uri('/instructors/{instructor}')
         * @name('instructors.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $instructor->update($request->validated());

        if ($address = $request->input('address')) {
            $this->dispatch(
                new SaveEntityAddressJob(
                    entity: $instructor,
                    address: $address,
                ),
            );
        }

        if ($phone = $request->input('phone')) {
            $this->dispatch(
                new PhoneSaveJob(
                    entity: $instructor,
                    phone: $phone,
                )
            );
        }

        return redirect()->route('instructors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return RedirectResponse
     */
    public function destroy(Instructor $instructor): RedirectResponse
    {
        /**
         * @delete('/instructors/{instructor}')
         * @name('instructors.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $instructor->delete();

        return redirect()->route('instructors.index');
    }
}
