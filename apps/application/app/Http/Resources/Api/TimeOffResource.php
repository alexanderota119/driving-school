<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseJsonResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin SomeModel
 */
class TimeOffResource extends BaseJsonResource
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
        ];
    }
}
