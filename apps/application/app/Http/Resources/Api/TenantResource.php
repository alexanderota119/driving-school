<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseJsonResource;
use App\Http\Resources\DomainResource;
use App\Models\Tenant;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin Tenant
 */
class TenantResource extends BaseJsonResource
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

        $test = \Storage::disk('public')->exists('logos/logo.png');

        return [
            'name'    => $this->name,
            'bgcolor' => $this->bgcolor,
            'fgcolor' => $this->fgcolor,

            'domains' => DomainResource::collection($this->whenLoaded('domains')),

            'logo' => $this->when($test, tenant_asset('logos/logo.png')),
        ];
    }
}
