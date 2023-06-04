<?php

namespace App\Traits\Models;

use App\Models\Address;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait AddressTrait
{
    public function addAddress($text, $member = null): Address
    {
        $member = $member ?? auth()->user();

        $data = [
            'text'          => $text,
            'userable_type' => optional($member)->getMorphClass(),
            'userable_id'   => optional($member)->id,
        ];

        return $this->addresses()->create($data);
    }

    public function addresses(): MorphMany|Address
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function myAddresses(): MorphMany|Address
    {
        return $this->morphMany(Address::class, 'userable');
    }

    public function address(): MorphOne|Address
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
