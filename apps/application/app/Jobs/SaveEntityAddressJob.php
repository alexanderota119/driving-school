<?php

namespace App\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SaveEntityAddressJob
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private $entity, private $address)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this_address = $this->address;

        if (isset($this_address['id'])) {
            $this->entity->address->update($this_address);

            return $this->entity->address;
        }

        if ($this_address) {
            return $this->entity->address()->create($this_address);
        }

        return false;
    }
}
