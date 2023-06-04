<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseJsonResource;
use App\Models\Car;
use Illuminate\Http\Request;

/**
 * @mixin Car
 */
class CarResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function getArray($request): array
    {
        return [
            'name'          => $this->name,
            'make'          => $this->make,
            'license_plate' => $this->license_plate,
            'model'         => $this->model,
            'color'         => $this->color,
            'year'          => $this->year,
        ];
    }
}
