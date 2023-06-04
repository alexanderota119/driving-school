<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialEventSaveRequest;
use App\Http\Resources\Api\SpecialEventResource;
use App\Models\SpecialEvent;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class SpecialEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        /**
         * @get('/special_events')
         * @name('special_events.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $special_event = SpecialEvent::all();

        return inertia('SpecialEvent/Manage', [
            'special_events' => SpecialEventResource::collection($special_event),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SpecialEventSaveRequest  $request
     * @return RedirectResponse
     */
    public function store(SpecialEventSaveRequest $request): RedirectResponse
    {
        /**
         * @post('/special_events')
         * @name('special_events.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        SpecialEvent::create($request->validated());

        return redirect()->route('special_events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        /**
         * @get('/special_events/create')
         * @name('special_events.create')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('SpecialEvent/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  SpecialEvent  $special_event
     * @return Response|ResponseFactory
     */
    public function show(SpecialEvent $special_event): Response|ResponseFactory
    {
        /**
         * @get('/special_events/{special_event}')
         * @name('special_events.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('SpecialEvent/Show', [
            'special_events' => SpecialEventResource::make($special_event),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SpecialEvent special_events
     * @return Response|ResponseFactory
     */
    public function edit(SpecialEvent $special_event): Response|ResponseFactory
    {
        /**
         * @get('/special_events/{special_event}/edit')
         * @name('special_events.edit')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('SpecialEvent/Edit', [
            'special_events' => SpecialEventResource::make($special_event),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SpecialEventSaveRequest  $request
     * @param  SpecialEvent  $special_event
     * @return RedirectResponse
     */
    public function update(SpecialEventSaveRequest $request, SpecialEvent $special_event): RedirectResponse
    {
        /**
         * @methods('PUT', PATCH')
         * @uri('/special_events/{special_event}')
         * @name('special_events.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $special_event->update($request->validated());

        return redirect()->route('special_events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  SpecialEvent  $special_event
     * @return RedirectResponse
     */
    public function destroy(SpecialEvent $special_event): RedirectResponse
    {
        /**
         * @delete('/special_events/{special_event}')
         * @name('special_events.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $special_event->delete();

        return redirect()->route('special_events.index');
    }
}
