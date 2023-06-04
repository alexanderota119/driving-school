<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;

class CreateTenantCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:tenant {tenant_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new tenant';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tenant_slug = \Str::slug($this->argument('tenant_name'));

        $tenant = Tenant::create([
            'id'   => $tenant_slug,
            'name' => $this->argument('tenant_name'),
        ]);

        return 0;
    }
}
