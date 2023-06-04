<?php

namespace App\Traits\Models;

use App\Models\Phone;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait PhoneTrait
{
    public function addPhone($text, $member = null): Phone
    {
        $member = $member ?? auth()->user();

        $data = [
            'text'          => $text,
            'userable_type' => optional($member)->getMorphClass(),
            'userable_id'   => optional($member)->id,
        ];

        return $this->phones()->create($data);
    }

    public function phones(): MorphMany|Phone
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function myPhones(): MorphMany|Phone
    {
        return $this->morphMany(Phone::class, 'userable');
    }

    public function phone(): MorphOne|Phone
    {
        return $this->morphOne(Phone::class, 'phoneable');
    }
}
