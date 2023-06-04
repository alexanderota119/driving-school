<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MissingResourceException;
use App\Http\Controllers\Controller;
use App\Models\Dropdown;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class DropdownController extends Controller
{
    public function selectOptions($model)
    {
        /**
         * @get('/api/dropdown/{model}')
         * @middlewares('web', 'tenant-web', 'tenant-instructors', 'tenant-instructors-api', 'Stancl\Tenancy\Middleware\InitializeTenancyByDomain', 'Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains')
         */
        $model_name = \Str::of($model)->singular()->studly()->toString();
        $model_path = \Str::of($model_name)->prepend('App\\Models\\')->toString();

        return \Cache::rememberForever(
            $model_name.'-options',
            function () use ($model_name, $model_path) {
                $resource_name_api = \Str::of($model_name)
                    ->prepend('App\\Http\\Resources\\')
                    ->append('Resource')
                    ->toString();

                $results = $model_path::all();

                if (class_exists($resource_name_api)) {
                    return $resource_name_api::collection($results);
                }

                $resource_name = \Str::of($model_name)
                    ->prepend('App\\Http\\Resources\\Api\\')
                    ->append('Resource')
                    ->toString();

                if (! class_exists($resource_name)) {
                    throw new MissingResourceException("Missing resource '{$resource_name}' or '{$resource_name_api}'");
                }

                return $resource_name::collection($results);
            }
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        $dropdown = Dropdown::all();

        return inertia('Dropdown/Manage', compact('dropdown'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Dropdown::create($request->validated());

        return redirect()->route('Dropdown.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Dropdown/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dropdown  $dropdown
     * @return Response|ResponseFactory
     */
    public function show(Dropdown $dropdown): Response|ResponseFactory
    {
        return inertia('Dropdown/Show', compact('dropdown'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dropdown  $dropdown
     * @return Response|ResponseFactory
     */
    public function edit(Dropdown $dropdown): Response|ResponseFactory
    {
        return inertia('Dropdown/Edit', compact('dropdown'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dropdown  $dropdown
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dropdown $dropdown)
    {
        $dropdown->update($request->validated());

        return redirect()->route('Dropdown.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dropdown  $dropdown
     * @return RedirectResponse
     */
    public function destroy(Dropdown $dropdown): RedirectResponse
    {
        $dropdown->delete();

        return redirect()->route('Dropdown.index');
    }
}
