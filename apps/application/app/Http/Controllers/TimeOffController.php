<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeOffSaveRequest;
use App\Http\Resources\Api\TimeOffResource;
use App\Models\TimeOff;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class TimeOffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        /**
         * @get('/time_off')
         * @name('time_off.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $time_offs = TimeOff::all();

        return inertia('TimeOff/Manage', [
            'time_offs' => TimeOffResource::collection($time_offs),
        ]);
    }

    public function my_requests(): Response|ResponseFactory
    {
        /**
         * @get('/my-requests')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $time_offs = auth()->user()->timeoffs();

        return inertia('TimeOff/Manage', [
            'time_offs' => TimeOffResource::collection($time_offs),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TimeOffSaveRequest  $request
     * @return RedirectResponse
     */
    public function store(TimeOffSaveRequest $request): RedirectResponse
    {
        /**
         * @post('/time_off')
         * @name('time_off.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        TimeOff::create($request->validated());

        return redirect()->route('time_offs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        /**
         * @get('/time_off/create')
         * @name('time_off.create')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('TimeOff/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  TimeOff  $time_off
     * @return Response|ResponseFactory
     */
    public function show(TimeOff $time_off): Response|ResponseFactory
    {
        /**
         * @get('/time_off/{time_off}')
         * @name('time_off.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('TimeOff/Show', compact('time_off'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  TimeOff  $time_off
     * @return Response|ResponseFactory
     */
    public function edit(TimeOff $time_off): Response|ResponseFactory
    {
        /**
         * @get('/time_off/{time_off}/edit')
         * @name('time_off.edit')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('TimeOff/Edit', compact('time_off'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TimeOffSaveRequest  $request
     * @param  TimeOff  $time_off
     * @return RedirectResponse
     */
    public function update(TimeOffSaveRequest $request, TimeOff $time_off): RedirectResponse
    {
        /**
         * @methods('PUT', PATCH')
         * @uri('/time_off/{time_off}')
         * @name('time_off.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $time_off->update($request->validated());

        return redirect()->route('time_offs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TimeOff  $time_off
     * @return RedirectResponse
     */
    public function destroy(TimeOff $time_off): RedirectResponse
    {
        /**
         * @delete('/time_off/{time_off}')
         * @name('time_off.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $time_off->delete();

        return redirect()->route('time_offs.index');
    }
}
