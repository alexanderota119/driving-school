<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseJsonResource;
use App\Models\Phone;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;

/**
 * @mixin Phone
 */
class PhoneResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function getArray($request)
    {
        $stop = 'here';

        return [
            'is_primary'      => $this->is_primary,
            'can_receive_sms' => (bool) $this->can_receive_sms,
            'number'          => $this->number,
            'number_fmt'      => $this->number_fmt,
        ];
    }
}
