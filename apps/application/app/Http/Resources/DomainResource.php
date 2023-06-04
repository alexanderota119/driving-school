<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;
use Stancl\Tenancy\Database\Models\Domain;

/**
 * @mixin Domain
 */
class DomainResource extends BaseJsonResource
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
            'id'     => $this->id,
            'domain' => $this->domain,
        ];
    }
}
