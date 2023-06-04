<?php

namespace App\Http\Resources;

use App\Models\Country;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin Country
 */
class CountryResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function getArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'name' => $this->name,
            'abbr' => $this->abbr,
        ];
    }
}
