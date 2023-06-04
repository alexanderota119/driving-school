<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin SomeModel
 */
class StateResource extends BaseJsonResource
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
            'name',
            'abbr',
            'country_id',

            'ratings' => CountryResource::make($this->whenLoaded('country')),
        ];
    }
}
