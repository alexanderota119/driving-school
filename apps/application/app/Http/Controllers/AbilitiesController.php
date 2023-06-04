<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;
use Silber\Bouncer\Database\Role;

class AbilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index()//: Response|ResponseFactory
    {
        $roles = Role::all();

        $roles->load('abilities');

        return response()->json(RoleResource::collection($roles));

        return inertia('Role/Manage', [
            'roles' => RoleResource::collection($roles),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Role::create($request->validated());

        return redirect()->route('Role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Role/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return Response|ResponseFactory
     */
    public function show(Role $role): Response|ResponseFactory
    {
        return inertia('Role/Show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return Response|ResponseFactory
     */
    public function edit(Role $role): Response|ResponseFactory
    {
        return inertia('Role/Edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->validated());

        return redirect()->route('Role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect()->route('Role.index');
    }
}
