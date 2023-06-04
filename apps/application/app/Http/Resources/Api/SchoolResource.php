<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseJsonResource;
use App\Models\School;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin School
 */
class SchoolResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function getArray($request): array|JsonSerializable|Arrayable
    {
        $this->addStandardNeeds();

        return [
            'name'  => $this->name,
            'label' => $this->name,
        ];
    }
}
