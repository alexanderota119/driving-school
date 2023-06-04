<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin SomeModel
 */
class AppointmentTypeResource extends BaseJsonResource
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
            'name'        => $this->name,
            'duration'    => $this->duration,
            'is_test'     => (bool) $this->is_test,
            'test_offset' => $this->test_offset,
            'order'       => $this->order,
        ];
    }
}
