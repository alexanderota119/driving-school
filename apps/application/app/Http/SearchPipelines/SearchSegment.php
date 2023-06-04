<?php

namespace App\Http\SearchPipelines;

class SearchSegment extends BaseSearchPipelines
{
    protected function applyFilter($builder, $param)
    {
        return $builder->search($param);
    }
}
