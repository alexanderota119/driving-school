<?php

namespace App\Http\SearchPipelines;

class EmailSegment extends BaseSearchPipelines
{
    protected function applyFilter($builder, $param)
    {
        return $builder->where('email', 'like', "%{$param}%");
    }
}
