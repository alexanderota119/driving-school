<?php

namespace App\Http\Resources;

use App\Helpers\Date;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin SomeModel
 */
class CalendarResource extends BaseJsonResource
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
            'title' => $this->name,
            'date'  => Date::dateObject($this->created_at),
            'start' => Date::dateObject($this->created_at),
        ];
    }
}
