<?php

namespace App\Http\Resources\Api;

use App\Helpers\Date;
use App\Http\Resources\BaseJsonResource;
use App\Models\SpecialEvent;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin SpecialEvent
 */
class SpecialEventResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function getArray($request): array|JsonSerializable|Arrayable
    {
        $rtv = [
            'name'       => $this->name,
            'date_start' => Date::dateObject($this->date_start),
            'end_date'   => Date::dateObject($this->end_date),
        ];

        return $rtv;
    }
}
