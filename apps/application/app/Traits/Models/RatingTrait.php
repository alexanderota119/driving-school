<?php

/** @noinspection ALL */

namespace App\Traits\Models;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait RatingTrait
{
    public function addRating($text, $member = null): Rating
    {
        $member = $member ?? auth()->user();

        $data = [
            'text'          => $text,
            'userable_type' => optional($member)->getMorphClass(),
            'userable_id'   => optional($member)->id,
        ];

        return $this->ratings()->create($data);
    }

    public function ratings(): MorphMany|Rating
    {
        return $this->morphMany(Rating::class, 'ratingable');
    }

    public function myRatings(): MorphMany|Rating
    {
        return $this->morphMany(Rating::class, 'userable');
    }

    public function getRatingAttribute(): string
    {
        $ratings = $this->ratings;

        if ($ratings->count() > 0) {
            return round($ratings->average('stars'), 2);
        }

        return 0;
    }
}
