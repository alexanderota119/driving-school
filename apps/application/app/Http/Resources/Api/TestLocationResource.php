<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseJsonResource;
use App\Models\TestLocation;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin TestLocation
 */
class TestLocationResource extends BaseJsonResource
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
            'name' => $this->name,
            'abbr' => $this->abbr,
        ];
    }
}
