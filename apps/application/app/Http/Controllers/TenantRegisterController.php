<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantSaveRequest;
use App\Jobs\SaveEntityAddressJob;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Inertia\Inertia;

class TenantRegisterController extends Controller
{
    public function register($plan_name)
    {
        /**
         * @get('/register/basic-info/{plan_name}')
         * @middlewares('web', 'central-web')
         *
         * @get('/register/basic-info/{plan_name}')
         * @middlewares('web', 'central-web')
         *
         * @get('/register/basic-info/{plan_name}')
         * @middlewares('web', 'central-web')
         *
         * @get('/register/basic-info/{plan_name}')
         * @middlewares('web', 'central-web')
         *
         * @get('/register/basic-info/{plan_name}')
         * @middlewares('web', 'central-web')
         */
        $default_domain = config('tenancy.included_domain');

        return inertia('CentralDomain/Register/BasicInformation', compact('plan_name', 'default_domain'));
    }

    public function registerSave(TenantSaveRequest $request)
    {
        /**
         * @post('/register')
         * @middlewares('web', 'central-web')
         *
         * @post('/register')
         * @middlewares('web', 'central-web')
         *
         * @post('/register')
         * @middlewares('web', 'central-web')
         *
         * @post('/register')
         * @middlewares('web', 'central-web')
         *
         * @post('/register')
         * @middlewares('web', 'central-web')
         */
        $tenant = Tenant::create([
            'id'   => \Str::slug($request->tenant_name),
            'name' => $request->tenant_name,
        ]);

        $tenant->run(function () use ($tenant, $request) {
            $user = User::create([
                'email'       => $request->email,
                'last_name'   => $request->last_name,
                'middle_name' => $request->middle_name,
                'first_name'  => $request->first_name,
                'password'    => $request->password,
            ]);

            event(new Registered($user));

            if ($request->has('address')) {
                $this->dispatch(
                    new SaveEntityAddressJob(
                        entity: $tenant,
                        address: $request->input('address')
                    ),
                );
            }
        });

        $url = sprintf(
            'http://%s.%s:%s/welcome',
            $tenant->id,
            config('tenancy.included_domain'),
            config('tenancy.included_domain_port')
        );

        return Inertia::location($url);
    }

    public function welcomeMessage()
    {
        /**
         * @get('/welcome')
         * @middlewares('web', 'tenant-web', 'guest')
         */
        $tenant = \tenant();

        return inertia('Home');
    }
}
