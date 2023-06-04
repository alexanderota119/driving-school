<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarSaveRequest;
use App\Http\Resources\Api\CarResource;
use App\Http\Resources\InstructorResource;
use App\Models\Car;
use App\Models\Instructor;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        /**
         * @get('/cars')
         * @name('cars.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $cars = Car::all();

        return inertia('Cars/Manage', [
            'cars' => CarResource::collection($cars),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CarSaveRequest  $request
     * @return RedirectResponse
     */
    public function store(CarSaveRequest $request): RedirectResponse
    {
        /**
         * @post('/cars')
         * @name('cars.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        Car::create($request->validated());

        return redirect()->route('cars.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        /**
         * @get('/cars/create')
         * @name('cars.create')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Cars/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  Car  $car
     * @return Response|ResponseFactory
     */
    public function show(Car $car): Response|ResponseFactory
    {
        /**
         * @get('/cars/{car}')
         * @name('cars.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Cars/Show', [
            'car' => CarResource::make($car),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Car  $car
     * @return Response|ResponseFactory
     */
    public function edit(Car $car): Response|ResponseFactory
    {
        /**
         * @get('/cars/{car}/edit')
         * @name('cars.edit')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $car->append('rating');

        $instructors = Instructor::all();

        return inertia('Cars/Edit', [
            'car'         => CarResource::make($car),
            'instructors' => InstructorResource::collection($instructors),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CarSaveRequest  $request
     * @param  Car  $car
     * @return RedirectResponse
     */
    public function update(CarSaveRequest $request, Car $car): RedirectResponse
    {
        /**
         * @methods('PUT', PATCH')
         * @uri('/cars/{car}')
         * @name('cars.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $car->update($request->validated());

        return redirect()->route('cars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Car  $car
     * @return RedirectResponse
     */
    public function destroy(Car $car): RedirectResponse
    {
        /**
         * @delete('/cars/{car}')
         * @name('cars.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $car->delete();

        return redirect()->route('cars.index');
    }
}
