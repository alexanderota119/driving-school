<?php

namespace App\Http\SearchPipelines;

use Illuminate\Support\Str;

class PhoneSegment extends BaseSearchPipelines
{
    protected function applyFilter($builder, $param)
    {
        $param = Str::of($param)
                ->replaceMatches('/\D/', '')
                ->replace(' ', '%')
                ->prepend('%')
                ->append('%').'';

        return $builder->whereHas('phones', function ($q) use ($param) {
            $q->where('number', 'like', $param);
        });
    }
}
