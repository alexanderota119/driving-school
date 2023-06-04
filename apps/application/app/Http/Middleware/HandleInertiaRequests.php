<?php

namespace App\Http\Middleware;

use App\Enums\UserTypes;
use App\Http\Resources\Api\StudentResource;
use App\Http\Resources\Api\TenantResource;
use App\Http\Resources\Api\UserResource;
use App\Http\Resources\InstructorResource;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     *
     * @param  Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @param  Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'tenant'      => fn () => TenantResource::make(tenant()),
            'tenant_name' => fn () => tenant('name') ?? config('app.name'),

            'auth.user' => function () use ($request) {
                $user = $request->user();

                if (! $user) {
                    return null;
                }

                switch ($user->user_type_id) {
                    case UserTypes::ADMIN:
                    case UserTypes::CENTRAL:
                    case UserTypes::GUEST:
                        $user = UserResource::make($user);
                        break;
                    case UserTypes::STUDENT:
                        $user = StudentResource::make($user);
                        break;
                    case UserTypes::INSTRUCTOR:
                        $user = InstructorResource::make($user);
                        break;
                }

                return $user;
            },

            'auth.abilities' => function () use ($request) {
                if (! auth()->check()) {
                    return [];
                }

                return \Cache::remember($request->user()->id.'-user-abilities', 15, function () use ($request) {
                    $user = $request->user();
                    $abilities = $user->getAbilities()->merge($user->getForbiddenAbilities());

                    $abilities->each(function ($ability) use ($user) {
                        $ability->forbidden = $user->getForbiddenAbilities()->contains($ability);
                    });

                    return $abilities;
                });
            },

            'auth.check'             => fn () => auth()->check(),
            'auth.check.instructors' => fn () => auth()->check(),
            'auth.check.student'     => fn () => auth()->check(),
            'auth_check'             => fn () => auth()->check(),

            'flash' => [
                'message' => fn () => $request->session()->get('message'),
            ],
        ]);
    }
}
