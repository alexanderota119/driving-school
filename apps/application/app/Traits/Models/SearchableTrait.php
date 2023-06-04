<?php

namespace App\Traits\Models;

use App\Http\SearchPipelines\SortSegment;
use Illuminate\Pipeline\Pipeline;

trait SearchableTrait
{
    public function scopeSearchPipline($query, array $searchSegments = [])
    {
        $segments = [];

        if (empty($searchSegments)) {
            $segments = $this->searchSegments;
            $segments[] = SortSegment::class;
        }

        return app(Pipeline::class)
            ->send($query)
            ->through($segments ?? $this->searchSegments)
            ->thenReturn();
    }
}
