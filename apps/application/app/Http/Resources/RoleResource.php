<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;
use Silber\Bouncer\Database\Role;

/**
 * @mixin Role
 */
class RoleResource extends BaseJsonResource
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
            'name'  => $this->name,
            'title' => $this->title,
            'scope' => $this->scope,

            'abilities' => AbilitiesResource::collection($this->whenLoaded('abilities')),
        ];
    }
}
