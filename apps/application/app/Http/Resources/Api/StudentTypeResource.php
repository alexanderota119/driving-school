<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseJsonResource;
use App\Models\StudentType;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin StudentType
 */
class StudentTypeResource extends BaseJsonResource
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
            'label' => $this->label,

            // for selects
            'value' => $this->id,
            'text'  => $this->label,

            'option' => [
                'value' => $this->id,
                'text'  => $this->label,
            ],
        ];
    }
}
