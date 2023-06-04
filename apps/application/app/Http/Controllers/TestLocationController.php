<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestLocationSaveRequest;
use App\Http\Resources\Api\TestLocationResource;
use App\Models\TestLocation;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class TestLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        /**
         * @get('/test_locations')
         * @name('test_locations.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $test_locations = TestLocation::all();

        return inertia('TestLocation/Manage', [
            'test_locations' => TestLocationResource::collection($test_locations),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TestLocationSaveRequest  $request
     * @return RedirectResponse
     */
    public function store(TestLocationSaveRequest $request): RedirectResponse
    {
        /**
         * @post('/test_locations')
         * @name('test_locations.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        TestLocation::create($request->validated());

        return redirect()->route('test_locations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        /**
         * @get('/test_locations/create')
         * @name('test_locations.create')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('TestLocation/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  TestLocation  $test_location
     * @return Response|ResponseFactory
     */
    public function show(TestLocation $test_location): Response|ResponseFactory
    {
        /**
         * @get('/test_locations/{test_location}')
         * @name('test_locations.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('TestLocation/Show', compact('test_location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  TestLocation  $test_location
     * @return Response|ResponseFactory
     */
    public function edit(TestLocation $test_location): Response|ResponseFactory
    {
        /**
         * @get('/test_locations/{test_location}/edit')
         * @name('test_locations.edit')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('TestLocation/Edit', compact('test_location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TestLocationSaveRequest  $request
     * @param  TestLocation  $test_location
     * @return RedirectResponse
     */
    public function update(TestLocationSaveRequest $request, TestLocation $test_location): RedirectResponse
    {
        /**
         * @methods('PUT', PATCH')
         * @uri('/test_locations/{test_location}')
         * @name('test_locations.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $test_location->update($request->validated());

        return redirect()->route('test_locations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TestLocation  $test_locations
     * @return RedirectResponse
     */
    public function destroy(TestLocation $test_locations): RedirectResponse
    {
        /**
         * @delete('/test_locations/{test_location}')
         * @name('test_locations.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $test_locations->delete();

        return redirect()->route('test_locations.index');
    }
}
