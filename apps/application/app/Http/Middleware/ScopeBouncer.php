<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Silber\Bouncer\Bouncer;

class ScopeBouncer
{
    /**
     * The Bouncer instance.
     *
     * @var Bouncer
     */
    protected Bouncer $bouncer;

    /**
     * Constructor.
     *
     * @param  Bouncer  $bouncer
     */
    public function __construct(Bouncer $bouncer)
    {
        $this->bouncer = $bouncer;
    }

    /**
     * Set the proper Bouncer scope for the incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (! auth()->check()) {
            return $next($request);
        }

        // Here you may use whatever mechanism you use in your app
        // to determine the current tenant. To demonstrate, the
        // $tenantId is set here from the user's account_id.
        $tenantId = auth()->user()->tenant_id;

        $this->bouncer->scope()->to($tenantId)->onlyRelations();

        return $next($request);
    }
}
