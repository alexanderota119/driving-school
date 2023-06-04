<?php

namespace App\Http\SearchPipelines;

use Illuminate\Support\Str;

/**
 * Class Address
 *
 * @example ?address[address_id]=123%20fake%20st
 */
class AddressSegment extends BaseSearchPipelines
{
    protected function applyFilter($builder, $param)
    {
        return $builder->whereHas('addresses', function ($q) use ($param) {
            $addressSearchable = [
                'address_1',
                'city',
                'postal_code',
            ];

            foreach ($addressSearchable as $searchable) {
                if (! isset($param[$searchable])) {
                    continue;
                }
                $term = Str::of($param[$searchable])
                        ->replace(' ', '%')
                        ->prepend('%')
                        ->append('%').'';

                $q->where($searchable, 'like', $term);
            }
        });
    }
}
