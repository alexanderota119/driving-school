<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantSaveRequest;
use App\Http\Resources\Api\TenantResource;
use App\Jobs\StoreFileJob;
use App\Models\Tenant;
use Arr;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        /**
         * @get('/tenants')
         * @name('tenants.index')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        auth()->user()->can('tenants.index');

        $tenants_query = Tenant::query();

        if (\tenant('id')) {
            $tenants_query->where('id', \tenant('id'));
        }

        $tenants = $tenants_query->get();

        return inertia('Tenant/Manage', [
            'tenants' => TenantResource::collection($tenants),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Tenant  $tenant
     * @return Response|ResponseFactory
     */
    public function show(Tenant $tenant): Response|ResponseFactory
    {
        /**
         * @get('/tenants/{tenant}')
         * @name('tenants.show')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Tenant/Show', compact('tenant'));
    }

    public function editMine()
    {
        $tenant = \tenant();

        return inertia('Tenant/Edit', [
            'tenant' => TenantResource::make($tenant),
        ]);
    }

    public function updateMine(TenantSaveRequest $request)
    {
        $tenant = \tenant();

        return $this->update($request, $tenant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TenantSaveRequest  $request
     * @param  Tenant  $tenant
     * @return RedirectResponse
     */
    public function update(TenantSaveRequest $request, Tenant $tenant): RedirectResponse
    {
        /**
         * @methods('PUT', PATCH')
         * @uri('/tenants/{tenant}')
         * @name('tenants.update')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $data = $request->validated();
        $domains = Arr::pull($data, 'domains', []);
        $tenant_domains = $tenant->domains->keyBy('id');

        unset($data['domains']);
        $tenant->update($request->validated());

        foreach ($domains as $domain) {
            if (isset($domain['id'])) {
                if (! $domain['domain']) {
                    $tenant_domains[$domain['id']]->delete();
                } else {
                    $tenant_domains[$domain['id']]->update($domain);
                }
            } else {
                $tenant->domains()->create($domain);
            }
        }

        if ($request->hasFile('file')) {
            $this->dispatch(
                new StoreFileJob(
                    file: $request->file('file'),
                    directory: 'logos',
                    file_name: 'logo.png',
                    public: true,
                )
            );
        }

        return redirect()->route('tenants.edit', $tenant);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        /**
         * @get('/tenants/create')
         * @name('tenants.create')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Tenant/Create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tenant  $tenant
     * @return Response|ResponseFactory
     */
    public function edit(Tenant $tenant): Response|ResponseFactory
    {
        /**
         * @get('/tenants/{tenant}/edit')
         * @name('tenants.edit')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $tenant->load('domains');

        return inertia('Tenant/Edit', compact('tenant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TenantSaveRequest  $request
     * @return RedirectResponse
     */
    public function store(TenantSaveRequest $request): RedirectResponse
    {
        /**
         * @post('/tenants')
         * @name('tenants.store')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        Tenant::create($request->validated());

        return redirect()->route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tenant  $tenant
     * @return RedirectResponse
     */
    public function destroy(Tenant $tenant): RedirectResponse
    {
        /**
         * @delete('/tenants/{tenant}')
         * @name('tenants.destroy')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $tenant->delete();

        return redirect()->route('tenants.index');
    }
}
