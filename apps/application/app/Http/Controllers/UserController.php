<?php

namespace App\Http\Controllers;

use App\Enums\UserTypes;
use App\Http\Requests\UserSaveRequest;
use App\Http\Resources\Api\UserResource;
use App\Jobs\PhoneSaveJob;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        /**
         * @get('/users')
         * @name('users.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $users = User::where('user_type_id', 'in', [
            UserTypes::CENTRAL,
            UserTypes::GUEST,
            UserTypes::ADMIN,
        ])->get();

        return inertia('Users/Manage', [
            'users' => UserResource::collection($users),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserSaveRequest  $request
     * @return RedirectResponse
     */
    public function store(UserSaveRequest $request): RedirectResponse
    {
        /**
         * @post('/users')
         * @name('users.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $user = User::create($request->validated());

        if ($phone = $request->input('phone')) {
            $this->dispatch(
                new PhoneSaveJob(
                    entity: $user,
                    phone: $phone,
                )
            );
        }

        return redirect()->route('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        /**
         * @get('/users/create')
         * @name('users.create')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Users/Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return Response|ResponseFactory
     */
    public function show(User $user)
    {
        /**
         * @get('/users/{user}')
         * @name('users.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $user->load(['address', 'phone']);

        return inertia('Users/Show', [
            'user' => UserResource::make($user),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return Response|ResponseFactory
     */
    public function edit(User $user): Response|ResponseFactory
    {
        /**
         * @get('/users/{user}/edit')
         * @name('users.edit')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $user->load(['address.state', 'phone']);

        return inertia('Users/Edit', [
            'user' => UserResource::make($user),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserSaveRequest  $request
     * @param  User  $user
     * @return RedirectResponse
     */
    public function update(UserSaveRequest $request, User $user): RedirectResponse
    {
        /**
         * @methods('PUT', PATCH')
         * @uri('/users/{user}')
         * @name('users.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $user->update($request->validated());

        if ($phone = $request->input('phone')) {
            $this->dispatch(
                new PhoneSaveJob(
                    entity: $user,
                    phone: $phone,
                )
            );
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        /**
         * @delete('/users/{user}')
         * @name('users.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $user->delete();

        return redirect()->route('users.index');
    }
}
