<?php

namespace App\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;

class StoreFileJob
{
    use Dispatchable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public $file, public string $file_name, public $directory = '', public bool $public = false)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->public) {
            $this->file->storeAs($this->directory, $this->file_name, 'public');

            return;
        }

        $this->file->storeAs($this->directory, $this->file_name);
    }
}
