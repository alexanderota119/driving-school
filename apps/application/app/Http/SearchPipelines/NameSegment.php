<?php

namespace App\Http\SearchPipelines;

class NameSegment extends BaseSearchPipelines
{
    protected function applyFilter($builder, $param)
    {
        $param = str_replace(' ', '%', $param);

        return $builder->where('name', 'like', "%{$param}%");
    }
}
