<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentTypeSaveRequest;
use App\Http\Resources\AppointmentTypeResource;
use App\Models\AppointmentType;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class AppointmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        /**
         * @get('/appointment_types')
         * @name('appointment_types.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $appointment_types = AppointmentType::all();

        return inertia('AppointmentType/Manage', [
            'appointment_types' => AppointmentTypeResource::collection($appointment_types),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(AppointmentTypeSaveRequest $request): RedirectResponse
    {
        /**
         * @post('/appointment_types')
         * @name('appointment_types.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        AppointmentType::create($request->validated());

        return redirect()->route('appointment_types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        /**
         * @get('/appointment_types/create')
         * @name('appointment_types.create')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('AppointmentType/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppointmentType  $appointment_type
     * @return Response|ResponseFactory
     */
    public function show(AppointmentType $appointment_type): Response|ResponseFactory
    {
        /**
         * @get('/appointment_types/{appointment_type}')
         * @name('appointment_types.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('AppointmentType/Show', [
            'appointment_type' => AppointmentTypeResource::make($appointment_type),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppointmentType  $appointment_type
     * @return Response|ResponseFactory
     */
    public function edit(AppointmentType $appointment_type): Response|ResponseFactory
    {
        /**
         * @get('/appointment_types/{appointment_type}/edit')
         * @name('appointment_types.edit')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('AppointmentType/Edit', [
            'appointment_type' => AppointmentTypeResource::make($appointment_type),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AppointmentTypeSaveRequest  $request
     * @param  \App\Models\AppointmentType  $appointment_type
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentTypeSaveRequest $request, AppointmentType $appointment_type)
    {
        /**
         * @methods('PUT', PATCH')
         * @uri('/appointment_types/{appointment_type}')
         * @name('appointment_types.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $appointment_type->update($request->validated());

        return redirect()->route('appointment_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppointmentType  $appointment_type
     * @return RedirectResponse
     */
    public function destroy(AppointmentType $appointment_type): RedirectResponse
    {
        /**
         * @delete('/appointment_types/{appointment_type}')
         * @name('appointment_types.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $appointment_type->delete();

        return redirect()->route('appointment_types.index');
    }
}
