<?php

namespace App\Http\Resources\Api;

use App\Models\Dropdown;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Dropdown
 */
class DropdownResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'slug'      => $this->slug,
            'type_name' => $this->type_name,
            'tenant_id' => $this->tenant_id,
        ];
    }
}
