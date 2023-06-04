<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseJsonResource;
use App\Models\Address;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin Address
 */
class AddressResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function getArray($request)
    {
        return [
            'street1'              => $this->street1,
            'street2'              => $this->street2,
            'street3'              => $this->street3,
            'city'                 => $this->city,
            'state_id'             => $this->state_id,
            'zipcode'              => $this->zipcode,
            'confirmed_on_service' => $this->confirmed_on_service,
            'is_verified'          => (bool) $this->confirmed_on_service,
        ];
    }
}
