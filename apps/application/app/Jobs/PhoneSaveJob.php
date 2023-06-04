<?php

namespace App\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;

class PhoneSaveJob
{
    use Dispatchable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public $entity, public $phone)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (! $this->phone) {
            return;
        }

        return $this->entity->phone()->updateOrCreate(['number' => $this->phone]);
    }
}
